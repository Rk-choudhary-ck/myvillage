<?php
// ══════════════════════════════════════════════════════════════════
// FILE: database/migrations/2024_01_01_000001_create_admin_users_table.php
// ══════════════════════════════════════════════════════════════════
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        // Admin Users Table (separate from regular users)
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('editor'); // super_admin, admin, editor
            $table->string('avatar')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Blogs Table
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('thumbnail')->nullable();
            $table->string('category')->default('General');
            $table->string('author')->default('Village Admin');
            $table->string('tags')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('views')->default(0);
            $table->foreignId('admin_user_id')->nullable()->constrained('admin_users')->nullOnDelete();
            $table->timestamps();
        });

        // Places Table
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('icon')->default('📍');
            $table->text('description');
            $table->longText('full_description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('location_name')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('best_time_to_visit')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Cultures Table
        Schema::create('cultures', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('icon')->default('🎭');
            $table->string('category'); // festival, music, food, craft
            $table->text('description');
            $table->longText('full_description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Activities Table
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->default('🎯');
            $table->string('category'); // sport, farming, tour, festival
            $table->string('season')->default('All Year');
            $table->text('description');
            $table->string('thumbnail')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Gallery Table
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->string('category')->default('General');
            $table->text('caption')->nullable();
            $table->string('alt_text')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Videos Table
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('video_type')->default('youtube'); // youtube, upload
            $table->string('video_url')->nullable();
            $table->string('video_path')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('category')->default('General');
            $table->string('duration')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Hero Slider Table
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('image')->nullable();
            $table->string('gradient')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->string('button2_text')->nullable();
            $table->string('button2_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Settings Table
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, image, boolean, textarea
            $table->string('group')->default('general');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        // Seed default admin user
        DB::table('admin_users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@chanankhera.in',
            'password' => Hash::make('Admin@123'),
            'role' => 'super_admin',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed default settings
        $settings = [
            ['key'=>'village_name','value'=>'Chanan Khera','type'=>'text','group'=>'general','label'=>'Village Name'],
            ['key'=>'village_tagline','value'=>'Village of Light — ਚਾਨਣ ਖੇੜਾ','type'=>'text','group'=>'general','label'=>'Tagline'],
            ['key'=>'village_description','value'=>'A timeless village in Punjab where nature whispers ancient stories and community is everything.','type'=>'textarea','group'=>'general','label'=>'Description'],
            ['key'=>'contact_email','value'=>'info@chanankhera.in','type'=>'text','group'=>'contact','label'=>'Contact Email'],
            ['key'=>'contact_phone','value'=>'+91 XXXXX XXXXX','type'=>'text','group'=>'contact','label'=>'Contact Phone'],
            ['key'=>'contact_address','value'=>'Chanan Khera Village, Punjab, India','type'=>'text','group'=>'contact','label'=>'Address'],
            ['key'=>'facebook_url','value'=>'#','type'=>'text','group'=>'social','label'=>'Facebook URL'],
            ['key'=>'instagram_url','value'=>'#','type'=>'text','group'=>'social','label'=>'Instagram URL'],
            ['key'=>'youtube_url','value'=>'#','type'=>'text','group'=>'social','label'=>'YouTube URL'],
            ['key'=>'total_residents','value'=>'2400','type'=>'text','group'=>'stats','label'=>'Total Residents'],
            ['key'=>'years_history','value'=>'500','type'=>'text','group'=>'stats','label'=>'Years of History'],
            ['key'=>'annual_festivals','value'=>'34','type'=>'text','group'=>'stats','label'=>'Annual Festivals'],
            ['key'=>'famous_places','value'=>'18','type'=>'text','group'=>'stats','label'=>'Famous Places'],
        ];
        foreach ($settings as $s) {
            DB::table('settings')->insert(array_merge($s, ['created_at'=>now(),'updated_at'=>now()]));
        }

        // Seed demo blog posts
        $blogs = [
            [
                'title' => 'Harvest Season: When the Whole Village Becomes One Family',
                'slug' => 'harvest-season-village-becomes-one-family',
                'excerpt' => 'The smell of fresh wheat, the rhythm of sickles, and voices singing harvest songs — this is what community truly means.',
                'content' => '<p>Every year when the wheat fields of Chanan Khera turn golden, something magical happens. The entire village — young and old, rich and working — comes together in a way that no modern city can replicate.</p><p>The harvest season, locally known as <em>Wariyaan</em>, begins in April and continues through May. Families who have farmed this land for generations bring their tools, their energy, and their songs to the fields at dawn.</p><h2>The Sound of Community</h2><p>You can hear the harvest coming before you see it. The rhythmic sound of sickles, the laughter of children running between cut stalks, the melodic folk songs that the women sing to keep pace — it all creates a symphony that defines what Chanan Khera truly is.</p>',
                'category' => 'Farming', 'author' => 'Village Admin',
                'is_published' => true, 'is_featured' => true, 'views' => 234,
                'created_at' => now()->subDays(15), 'updated_at' => now()->subDays(15),
            ],
            [
                'title' => 'The Last Bhangra Master of Chanan Khera',
                'slug' => 'last-bhangra-master-chanan-khera',
                'excerpt' => 'At 82, Gurdev Singh ji is the only remaining keeper of a rare bhangra style that could vanish with him forever.',
                'content' => '<p>Gurdev Singh ji was born with the dhol in his heart. By the age of seven, he could feel the beat of the drum before it struck. By twelve, he had mastered footwork that left entire villages speechless.</p><p>But today, as he sits in the courtyard of his small home in Chanan Khera, watching children scroll on smartphones, he worries. Who will carry this forward?</p>',
                'category' => 'Culture', 'author' => 'Village Admin',
                'is_published' => true, 'is_featured' => false, 'views' => 189,
                'created_at' => now()->subDays(8), 'updated_at' => now()->subDays(8),
            ],
            [
                'title' => 'Restoration of Our 300-Year-Old Gurdwara Sahib Begins',
                'slug' => 'restoration-300-year-old-gurdwara-begins',
                'excerpt' => 'Community effort brings new life to the ancient Sikh shrine that has witnessed five centuries of prayer and devotion.',
                'content' => '<p>The Gurdwara Sahib of Chanan Khera has stood for over 300 years. Through invasions, famines, floods, and the partition of 1947, its walls have witnessed it all — and held firm.</p><p>Now, after years of planning and community fundraising, the restoration project has finally begun. Over 200 families from the village and diaspora have contributed to bring new life to this sacred space.</p>',
                'category' => 'Heritage', 'author' => 'Village Admin',
                'is_published' => true, 'is_featured' => false, 'views' => 312,
                'created_at' => now()->subDays(3), 'updated_at' => now()->subDays(3),
            ],
        ];
        foreach ($blogs as $b) DB::table('blogs')->insert($b);

        // Seed demo places
        $places = [
            ['name'=>'Village Gurdwara Sahib','slug'=>'village-gurdwara-sahib','category'=>'Sacred Site','icon'=>'🕌','description'=>'A 300-year-old Sikh shrine that has witnessed centuries of prayer, langar, and community gathering.','is_featured'=>true,'is_active'=>true,'sort_order'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Chanan Khera Village Pond','slug'=>'chanan-khera-village-pond','category'=>'Water Body','icon'=>'💧','description'=>'A crystal-clear village pond reflecting golden sunrises — the heart of village social life.','is_featured'=>true,'is_active'=>true,'sort_order'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'The Ancient Banyan Tree','slug'=>'ancient-banyan-tree','category'=>'Nature','icon'=>'🌳','description'=>'A 400-year-old banyan tree where elders gather for evening tales and children play in its shade.','is_featured'=>true,'is_active'=>true,'sort_order'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Old Haveli of Chanan Khera','slug'=>'old-haveli-chanan-khera','category'=>'Heritage','icon'=>'🏛','description'=>'Magnificent 18th-century architecture with intricate frescoes and carved wooden doors.','is_featured'=>true,'is_active'=>true,'sort_order'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Golden Wheat Fields','slug'=>'golden-wheat-fields','category'=>'Agriculture','icon'=>'🌾','description'=>'Endless fields turning gold at harvest — a breathtaking sight unique to Punjab.','is_featured'=>true,'is_active'=>true,'sort_order'=>5,'created_at'=>now(),'updated_at'=>now()],
        ];
        foreach ($places as $p) DB::table('places')->insert($p);

        // Seed cultures
        $cultures = [
            ['title'=>'Baisakhi Festival','icon'=>'🌾','category'=>'festival','description'=>'The grandest harvest festival, celebrated with bhangra, langar, and the entire community gathered in joy.','is_active'=>true,'sort_order'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['title'=>'Bhangra & Giddha','icon'=>'🥁','category'=>'music','description'=>'The soul of Punjab — energetic folk dances performed at every celebration and passed through generations.','is_active'=>true,'sort_order'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['title'=>'Phulkari Embroidery','icon'=>'🧵','category'=>'craft','description'=>'Intricate hand-embroidered textiles on silk — our village women have won national recognition for this art.','is_active'=>true,'sort_order'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['title'=>'Traditional Punjabi Cuisine','icon'=>'🍲','category'=>'food','description'=>'Makki di Roti, Sarson da Saag, rich Lassi and wood-fire Daal — flavors that define Punjab.','is_active'=>true,'sort_order'=>4,'created_at'=>now(),'updated_at'=>now()],
        ];
        foreach ($cultures as $c) DB::table('cultures')->insert($c);
    }

    public function down(): void {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('sliders');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('cultures');
        Schema::dropIfExists('places');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('admin_users');
    }
};
