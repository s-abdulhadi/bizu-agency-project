<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Make type nullable and add price if they don't exist
            if (Schema::hasColumn('services', 'type')) {
                $table->string('type')->nullable()->change();
            }

            if (!Schema::hasColumn('services', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('long_description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'type')) {
                $table->string('type')->nullable(false)->change();
            }

            if (Schema::hasColumn('services', 'price')) {
                $table->dropColumn('price');
            }
        });
    }
};
