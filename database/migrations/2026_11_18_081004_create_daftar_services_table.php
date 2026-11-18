
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daftar_services', function (Blueprint $table) {
            $table->string('id_servis', 20)->primary();

            $table->string('no_plat', 15);
            $table->string('id_pelanggan', 20);

            $table->text('keluhan_kendaraan');
            $table->date('tanggal_servis');
            $table->timestamps();

            $table->foreign('no_plat')
                ->references('no_plat')->on('kendaraans')
                ->cascadeOnUpdate();

            $table->foreign('id_pelanggan')
                ->references('id_pelanggan')->on('pelanggans')
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daftar_services');
    }
};
