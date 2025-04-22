    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('pemesanans', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_user');
                $table->unsignedBigInteger('id_pengguna');
                $table->unsignedBigInteger('id_tiket');
                $table->integer('jumlah');
                $table->dateTime('tanggal_pemesanan');
                $table->timestamps();
                $table->foreign('id_pengguna')->references('id')->on('penggunas')->onDelete('cascade');
                $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('id_tiket')->references('id')->on('tikets')->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('pemesanans');
        }
    };
