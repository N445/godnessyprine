<?php

namespace App\Command;

use App\Entity\Sirop;
use App\Entity\SiropImage;
use App\Repository\SiropRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[AsCommand(
    name: 'app:sirops:create',
    description: 'Add a short description for your command',
)]
class SiropsCreateCommand extends Command
{
    private EntityManagerInterface $em;

    private SiropRepository        $siropRepository;

    public function __construct(EntityManagerInterface $em, SiropRepository $siropRepository)
    {
        parent::__construct();
        $this->em              = $em;
        $this->siropRepository = $siropRepository;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        foreach ($this->siropRepository->findAll() as $item) {
            $this->em->remove($item);
        }
        $this->em->flush();

        $fileSystem = new Filesystem();

        $imageDir = __DIR__ . '/images/';

        $images = [
            'venus-1.jpg',
            'venus-2.jpg',
            'isis-1.jpg',
            'isis-2.jpg',
            'artemis-1.jpg',
            'artemis-2.jpg',
            'athena-1.jpg',
        ];

        foreach ($images as $image) {
            $fileSystem->copy($imageDir . $image, $imageDir . 'copy-' . $image);
        }

        $sirop1 = new SiropImage();
        $sirop1->setImageFile(new UploadedFile($imageDir . 'copy-venus-1.jpg', 'venus-1.jpg', null, null, true));
        $sirop2 = new SiropImage();
        $sirop2->setImageFile(new UploadedFile($imageDir . 'copy-venus-2.jpg', 'venus-2.jpg', null, null, true));

        $sirop3 = new SiropImage();
        $sirop3->setImageFile(new UploadedFile($imageDir . 'copy-isis-1.jpg', 'isis-1.jpg', null, null, true));
        $sirop4 = new SiropImage();
        $sirop4->setImageFile(new UploadedFile($imageDir . 'copy-isis-2.jpg', 'isis-2.jpg', null, null, true));

        $sirop5 = new SiropImage();
        $sirop5->setImageFile(new UploadedFile($imageDir . 'copy-artemis-1.jpg', 'artemis-1.jpg', null, null, true));
        $sirop6 = new SiropImage();
        $sirop6->setImageFile(new UploadedFile($imageDir . 'copy-artemis-2.jpg', 'artemis-2.jpg', null, null, true));

        $sirop7 = new SiropImage();
        $sirop7->setImageFile(new UploadedFile($imageDir . 'copy-athena-1.jpg', 'athena-1.jpg', null, null, true));
//        $sirop8 = new SiropImage();
//        $sirop8->setImageFile(new UploadedFile($imageDir . 'copy-athena-2.jpg', 'athena-2.jpg', null, null, true));

        $data = [
            (new Sirop())
                ->setTitle('Vénus')
                ->setUrlSlug('venus')
                ->setDescription("<p>Avec Vénus, c'est un feu de douceur que tu t'offres.</p><p>Une énergie aussi tendre qu'ardente te traverse le corp.</p><p>C'est l'amour.</p><p>Ferme les yeux, laisse toi porter par tes sens. Donne toi l'occasion de découvrir.</p><p>&nbsp;</p><p>Notes florales et citronnées,</p><p>&nbsp;consommer :</p><p>- avec une eau bien fraîche</p><p>- en tisane</p><p>&nbsp;- en glace et sorbet&nbsp;</p><p>- en préparation culinaire (sauce, vinaigrette, pâtisserie)</p><p>N'hésitez pas à me soumettre vos retours de Chef.fe, j'ai hâte de découvrir l'étandue des possibilités de ce&nbsp;sirop&nbsp;avec vous !&nbsp;</p><p>&nbsp;</p><p>Sirop Verveine citronnée et Rose</p><p>(Nombril de Vénus et Lierre)</p><p>Plantes fraîches uniquement</p><p>Sans arôme, sans conservateur</p><p>&nbsp;</p><p>Fabriqué avec amour, pressé au torchon, naturel et artisanal, utilisation de techniques ancestrales&nbsp;</p>")
                ->setIngredients("<p><em>Saccharose</em></p><p><em>Aqua</em></p><p><em>Pelargonium Rosat</em></p><p><em>Verbena Officinalis</em></p><p><em>Umbilicus</em></p><p><em>Hedera Helix</em></p>")
                ->setPrice(1300)
                ->setDisplayOrder(10)
                ->addImage($sirop1)
                ->addImage($sirop2)
            ,
            (new Sirop())
                ->setTitle('Isis')
                ->setUrlSlug('isis')
                ->setDescription("<p>Avec Isis, c'est un voyage vers le méconnu&nbsp;que tu t'offres.&nbsp;</p><p>Une effluve&nbsp;d'Égypte et de ses rituels antiques remplie&nbsp;ton corp.</p><p>C'est la magie.</p><p>Ferme les yeux et laisse toi porter par tes sens, donne toi l'occasion de découvrir.</p><p>&nbsp;</p><p>Notes florales et camphrées</p><p>À consommer :</p><p>- avec une eau bien fraîche</p><p>- en tisane</p><p>&nbsp;- en glace et sorbet&nbsp;</p><p>- en préparation culinaire (sauce, vinaigrette, pâtisserie)</p><p>N'hésitez pas à me soumettre vos retours de Chef.fe, j'ai hâte de découvrir l'étandue des possibilités de ce&nbsp;sirop&nbsp;avec vous !</p><p>&nbsp;</p><p>Sirop Basilic et Bleut</p><p>(Chardon-Marie et Ortie)</p><p>Plantes fraîches et séchées</p><p>Sans arôme, sans conservateur</p><p>&nbsp;</p><p>Fabriqué avec amour, pressé au torchon, naturel et artisanal, utilisation de techniques ancestrales</p>")
                ->setIngredients("<p><em>Saccharose</em></p><p><em>Aqua</em></p><p><em>Ocimum Basilicum</em></p><p><em>Centaurea Cyanus</em></p><p><em>Silybum Marianum</em></p><p><em>Urtica</em></p>")
                ->setPrice(1300)
                ->setDisplayOrder(20)
                ->addImage($sirop3)
                ->addImage($sirop4)
            ,
            (new Sirop())
                ->setTitle('Artémis')
                ->setUrlSlug('artemis')
                ->setDescription("<p>Avec Artémis, c'est un vent de rebellion que tu t'offres.</p><p>Un long voyage vers l'indépence s'ouvre à toi.</p><p>C'est la force.</p><p>Ferme les yeux et laisse toi porter par tes sens, donne toi l'occasion&nbsp;de découvrir.</p><p>&nbsp;</p><p>Notes vertes et anisées</p><p>À consommer :</p><p>- avec une eau bien fraîche</p><p>- en tisane</p><p>&nbsp;- en glace et sorbet&nbsp;</p><p>- en préparation culinaire (sauce, vinaigrette, pâtisserie)</p><p>N'hésitez pas à me soumettre vos retours de Chef.fe, j'ai hâte de découvrir l'étandue des possibilités de ce&nbsp;sirop&nbsp;avec vous !</p><p>&nbsp;</p><p>Sirop Estragon et Oeillet Passion</p><p>(Absinthe et Ortie)</p><p>Plantes fraîches et séchées</p><p>Sans arôme, sans conservateur</p><p>&nbsp;</p><p>Fabriqué avec amour,pressé au torchon, naturel et artisanal, utilisation de techniques ancestrales</p>")
                ->setIngredients("<p><em>Saccharose</em></p><p><em>Aqua</em></p><p><em>Tagete Lucida</em></p><p><em>Tagete Patula</em></p><p><em>Artemisia Absinthium</em></p><p><em>Urtica</em></p>")
                ->setPrice(1300)
                ->setDisplayOrder(30)
                ->addImage($sirop5)
                ->addImage($sirop6)
            ,
            (new Sirop())
                ->setTitle('Athéna')
                ->setUrlSlug('athena')
                ->setDescription("<p>Avec Athéna, c'est un esprit neuf que tu t'offres.</p><p>De calmes&nbsp;et solides reflexions viennent à toi.</p><p>C'est la sagesse.</p><p>Ferme les yeux et laisse toi porter par tes sens. Donne toi l'occasion de découvrir.</p><p>&nbsp;</p><p>Notes rondes et chaleureuse</p><p>À consommer :</p><p>- avec une eau bien fraîche</p><p>- en tisane</p><p>&nbsp;- en glace et sorbet&nbsp;</p><p>- en préparation culinaire (sauce, vinaigrette, pâtisserie)</p><p>N'hésitez pas à me soumettre vos retours de Chef.fe, j'ai hâte de découvrir l'étandue des possibilités de ce&nbsp;sirop&nbsp;avec vous !</p><p>&nbsp;</p><p>Sirop&nbsp;Châtaigne et Bourrache</p><p>(Feuille d'olivier et Lierre)&nbsp;</p><p>Plantes fraîches et séchées</p><p>Sans arôme, sans conservateur</p><p>&nbsp;</p><p>Fabriqué avec amour, pressé au torchon, naturel et artisanal, utilisation de techniques ancestrales</p>")
                ->setIngredients("<p>Saccharose</p><p>Aqua</p><p>Castanea</p><p>Borago Officinalis</p><p>Folium Olea Europea</p><p>Hedera Helix</p>")
                ->setPrice(1300)
                ->setDisplayOrder(40)
                ->addImage($sirop7)
            //                ->addImage($sirop8)
            ,
        ];

        foreach ($data as $datum) {
            $this->em->persist($datum);
        }
        $this->em->flush();

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
