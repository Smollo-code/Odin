<?php

declare(strict_types=1);

require_once './vendor/autoload.php';


use Phinx\Seed\AbstractSeed;

class StatusSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */

    private function firstDelete() : void
    {
        $posts = $this->table('user');
        $posts->truncate();
    }

    private function saving(array $data) : void
    {
        $posts = $this->table('user');
        $posts->insert($data)
            ->saveData();
    }

    private function alwaysUsers() : void
    {
        $flo = [
            'username' => 'Flo',
            'password' => password_hash('123', PASSWORD_BCRYPT)
        ];
        $this->saving($flo);
        $maxi = [
            'username' => 'Maxi',
            'password' => password_hash('123', PASSWORD_BCRYPT)
        ];
        $this->saving($maxi);
        $benny = [
            'username' => 'Benny',
            'password' => password_hash('123', PASSWORD_BCRYPT)
        ];
        $this->saving($benny);

    }

    public function run() : void
    {

        $faker = Faker\Factory::create();

        $this->firstDelete();
        $this->alwaysUsers();
        for ($i=0; $i < 100; $i++)
        {
            $data = [];
            $data['username'] = $faker->name();
            $data['password'] = password_hash('123', PASSWORD_BCRYPT);
            $this->saving($data);
        }
    }
}
