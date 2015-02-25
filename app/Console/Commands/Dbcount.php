<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Dbcount extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'db:count';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Count the rows of a database table';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$tablename = $this->argument('table');

		if(! Schema::hasTable($tablename)) {
			return $this->error("$tablename does not exist in the database");
		} else {
			$table = DB::table($tablename);
			$count = $table->count();
			return $this->info("$tablename table has $count rows.");
		}
	}

	/**
	 * Get the console arguments
	 *
	 * @return array
	 */
	protected function getArguments() {
		return [
							['table', InputArgument::REQUIRED, 'Table name'],
						];
	}

	/**
	 * Get the console command options
	 *
	 * @return array
	 */
	protected function getOptions() {
		return [];
	}
}
