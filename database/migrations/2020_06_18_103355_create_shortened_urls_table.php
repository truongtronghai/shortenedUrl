<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortenedUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('url'); // url neu trung nhau thi show lai ket qua cu, khong tao them cai moi duplicate
            $table->string('shortened')->unique();
            $table->bigInteger('count')->default(0); // dem so luot su dung cua url. Moi khoi tao se la 0
            $dt = new DateTime(now());
            $table->timestamp('created_at')->default(date_format($dt, 'Y-m-d h:m:s'));
            $table->timestamp('expired_at')->default(date_format($dt->add(new DateInterval('P6M')), 'Y-m-d h:m:s')); // het han mac dinh la 6 thang
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urls');
    }
}
