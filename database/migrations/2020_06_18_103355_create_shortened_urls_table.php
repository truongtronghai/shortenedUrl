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
            $table->bigIncrements('id')->unsigned();
            $table->foreignId('user_id')->nullable(false)->default(2);
            $table->text('url'); // url neu trung nhau thi show lai ket qua cu, khong tao them cai moi duplicate
            $table->string('shortened')->collation('utf8mb4_bin')->unique()->nullable(false); // khai bao collation de column phan biet hoa thuong ( case sensitive )
            $table->bigInteger('count')->default(0); // dem so luot su dung cua url. Moi khoi tao se la 0
            $dt = new DateTime(now());
            $table->timestamp('created_at')->default(date_format($dt, 'Y-m-d h:m:s'));
            $dt = $dt->add(new DateInterval('P3M')); // het han mac dinh la 3 thang (P3M)
            $table->timestamp('expired_at')->default(date_format($dt, 'Y-m-d h:m:s'));
            $dt = $dt->add(new DateInterval('P3M')); // them 3 thang de luu giu truoc khi tai su dung
            $table->timestamp('kept_to')->default(date_format($dt, 'Y-m-d h:m:s'));
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
