<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            MembroQuadroConviteSeeder::class,
            MembroWorkplaceSeeder::class,
            ChatAnexoSeeder::class,
            TipoUserSeeder::class,
            ListaVerificacaoSeeder::class,
            AnexoSeeder::class,
            ItemListaVerificacaoSeeder::class,
            MembroQuadroSeeder::class,
            WorkplaceSeeder::class,
            CartaoEtiquetaSeeder::class,
            ChatMensagemSeeder::class,
            UserSeeder::class,
            MembroWorkplaceConviteSeeder::class,
            ListaSeeder::class,
            MembroCartaoSeeder::class,
            EtiquetaSeeder::class,
            CartaoSeeder::class,
            QuadroSeeder::class,
            ComentarioSeeder::class,
        ]);
    }
}
