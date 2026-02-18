<?php
// ══════════════════════════════════════════
// FILE: app/Http/Controllers/Admin/Auth/AdminLoginController.php
// ══════════════════════════════════════════
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    public function showLogin()
    {
        if (Session::has('admin_user_id')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $admin = AdminUser::where('email', $request->email)
                          ->where('is_active', true)
                          ->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
        }

        // Store admin in session (separate from regular auth)
        Session::put('admin_user_id', $admin->id);
        Session::put('admin_user_name', $admin->name);
        Session::put('admin_user_role', $admin->role);

        // Update last login
        $admin->update(['last_login_at' => now()]);

        if ($request->remember) {
            // Set a long-lived cookie
            cookie()->queue('admin_remember', $admin->id, 60 * 24 * 30);
        }

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Welcome back, ' . $admin->name . '!');
    }

    public function logout(Request $request)
    {
        Session::forget(['admin_user_id', 'admin_user_name', 'admin_user_role']);
        return redirect()->route('admin.login')
                         ->with('success', 'You have been logged out successfully.');
    }
}

/*
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
FILE: app/Http/Middleware/AdminAuthMiddleware.php
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
*/
// namespace App\Http\Middleware;
// use Closure; use Illuminate\Http\Request; use Illuminate\Support\Facades\Session;
// class AdminAuthMiddleware {
//   public function handle(Request $request, Closure $next) {
//     if (!Session::has('admin_user_id')) {
//       return redirect()->route('admin.login')->with('error','Please login to access admin panel.');
//     }
//     return $next($request);
//   }
// }

/*
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
FILE: app/Models/AdminUser.php
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
*/
// namespace App\Models;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
//
// class AdminUser extends Authenticatable {
//   use HasFactory;
//   protected $table = 'admin_users';
//   protected $fillable = ['name','email','password','role','avatar','is_active','last_login_at'];
//   protected $hidden = ['password','remember_token'];
//   protected $casts = ['is_active'=>'boolean','last_login_at'=>'datetime'];
//
//   public function isSuperAdmin(): bool { return $this->role === 'super_admin'; }
//   public function isAdmin(): bool { return in_array($this->role, ['super_admin','admin']); }
// }

/*
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
FILE: app/Http/Controllers/Admin/DashboardController.php
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
*/
// namespace App\Http\Controllers\Admin;
// use App\Http\Controllers\Controller;
// use App\Models\{Blog, Place, Gallery, Video};
//
// class DashboardController extends Controller {
//   public function index() {
//     return view('admin.dashboard.index', [
//       'stats' => [
//         'blogs'          => Blog::count(),
//         'published_blogs'=> Blog::where('is_published',true)->count(),
//         'places'         => Place::count(),
//         'gallery'        => Gallery::count(),
//         'videos'         => Video::count(),
//         'views'          => Blog::sum('views'),
//       ],
//       'recentBlogs'   => Blog::latest()->take(8)->get(),
//       'recentPlaces'  => Place::orderBy('sort_order')->take(6)->get(),
//       'recentGallery' => Gallery::latest()->take(6)->get(),
//     ]);
//   }
// }

/*
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
FILE: app/Http/Controllers/Admin/BlogAdminController.php
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
*/
// namespace App\Http\Controllers\Admin;
// use App\Http\Controllers\Controller;
// use App\Models\Blog;
// use Illuminate\Http\Request;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Storage;
//
// class BlogAdminController extends Controller {
//   public function index() {
//     $blogs = Blog::latest()->paginate(15);
//     return view('admin.blogs.index', compact('blogs'));
//   }
//   public function create() { return view('admin.blogs.form'); }
//   public function store(Request $request) {
//     $data = $request->validate([
//       'title'=>'required|max:255',
//       'excerpt'=>'required',
//       'content'=>'required',
//       'category'=>'required',
//       'author'=>'nullable',
//       'tags'=>'nullable',
//       'meta_description'=>'nullable|max:160',
//     ]);
//     $data['slug'] = $request->slug ?: Str::slug($data['title']);
//     $data['is_published'] = $request->boolean('is_published');
//     $data['is_featured'] = $request->boolean('is_featured');
//     if ($request->hasFile('thumbnail')) {
//       $data['thumbnail'] = $request->file('thumbnail')->store('blogs','public');
//     }
//     Blog::create($data);
//     return redirect()->route('admin.blogs.index')->with('success','Blog post created!');
//   }
//   public function edit(Blog $blog) { return view('admin.blogs.form', compact('blog')); }
//   public function update(Request $request, Blog $blog) {
//     $data = $request->validate(['title'=>'required','excerpt'=>'required','content'=>'required','category'=>'required']);
//     $data['is_published'] = $request->boolean('is_published');
//     $data['is_featured'] = $request->boolean('is_featured');
//     if ($request->hasFile('thumbnail')) {
//       if ($blog->thumbnail) Storage::disk('public')->delete($blog->thumbnail);
//       $data['thumbnail'] = $request->file('thumbnail')->store('blogs','public');
//     }
//     $blog->update($data);
//     return redirect()->route('admin.blogs.index')->with('success','Blog post updated!');
//   }
//   public function destroy(Blog $blog) {
//     if ($blog->thumbnail) Storage::disk('public')->delete($blog->thumbnail);
//     $blog->delete();
//     return back()->with('success','Blog post deleted!');
//   }
//   public function togglePublish(Blog $blog) {
//     $blog->update(['is_published' => !$blog->is_published]);
//     return back()->with('success','Status updated!');
//   }
// }

/*
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
FILE: app/Http/Controllers/Frontend/HomeController.php
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
*/
// namespace App\Http\Controllers\Frontend;
// use App\Http\Controllers\Controller;
// use App\Models\{Blog, Place, Gallery, Video, Culture};
//
// class HomeController extends Controller {
//   public function index() {
//     return view('frontend.home.index', [
//       'featuredPlaces'  => Place::where('is_featured',true)->where('is_active',true)->orderBy('sort_order')->take(5)->get(),
//       'recentBlogs'     => Blog::published()->latest()->take(3)->get(),
//       'galleryPreview'  => Gallery::where('is_active',true)->latest()->take(8)->get(),
//       'recentVideos'    => Video::where('is_active',true)->latest()->take(3)->get(),
//       'featuredVideo'   => Video::where('is_featured',true)->first(),
//       'activities'      => \App\Models\Activity::where('is_active',true)->orderBy('sort_order')->get(),
//     ]);
//   }
//   public function about() { return view('frontend.about'); }
//   public function contact() { return view('frontend.contact'); }
//   public function contactSubmit(Request $request) {
//     $request->validate(['name'=>'required','email'=>'required|email','message'=>'required']);
//     // Send email / save to DB
//     return back()->with('success','Thank you! We will get back to you soon.');
//   }
// }
