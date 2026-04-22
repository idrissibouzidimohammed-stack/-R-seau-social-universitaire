<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('prenom')->nullable()->after('name');
            $table->string('role')->default('etudiant')->after('email');
            $table->text('bio')->nullable()->after('role');
            $table->string('photo')->nullable()->after('bio');
            $table->string('filiere')->nullable()->after('photo');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['prenom', 'role', 'bio', 'photo', 'filiere']);
        });
    }
};