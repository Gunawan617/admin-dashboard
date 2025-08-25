
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
		Schema::table('posts', function (Blueprint $table) {
			$table->string('meta_title')->nullable();
			$table->text('meta_description')->nullable();
			$table->text('meta_keywords')->nullable();
			$table->string('canonical_url')->nullable();
			$table->dateTime('published_at')->nullable();
			$table->enum('status', ['draft', 'published', 'archived'])->default('draft');
			$table->string('author')->nullable();
			$table->string('category')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function (Blueprint $table) {
			$table->dropColumn([
				'meta_title',
				'meta_description',
				'meta_keywords',
				'canonical_url',
				'published_at',
				'status',
				'author',
				'category',
			]);
		});
	}
};
