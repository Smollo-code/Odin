<?php

declare(strict_types=1);

require_once './vendor/autoload.php';


use Phinx\Seed\AbstractSeed;

class StatusSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your Database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */

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
            'password' => password_hash('123', PASSWORD_BCRYPT),
            'profileurl' => 'https://img.welt.de/img/wissenschaft/mobile195431695/1022506097-ci102l-w1024/A-portrait-of-a-beagle-that-was-a-rescued-dog-2.jpg'
        ];
        $this->saving($benny);

        $admin = [
            'username' => 'Admin',
            'password' => password_hash('admin', PASSWORD_BCRYPT),
            'profileurl' => ''
        ];
        $this->saving($admin);

    }

    public function run() : void
    {

        $faker = Faker\Factory::create();

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
