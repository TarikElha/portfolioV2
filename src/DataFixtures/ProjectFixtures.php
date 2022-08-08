<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $project1 = new Project();
        $project1->setTitle('Project 1');
        $project1->setDescription('Ok term north similar still.\nScientist program yet phone marriage keep. Machine black road newspaper level show herself. Instead economic another agent.', 'Vote surface my page board set policy. From people adult operation wide general society. Sort trade yourself strategy all yet.\nMyself morning black.', 'Behind available best manage. Movement clear even somebody water.\nDown cultural expect son watch behavior sit base. More mean serve at weight. Suffer pressure move field late.');
        $project1->setDate(new DateTime('12/11/2000'));
        $project1->addCategory($this->getReference('category_0'));
        $project1->addImage($this->getReference('image_0'));
        $manager->persist($project1);

        $project2 = new Project();
        $project2->setTitle('Project 2');
        $project2->setDescription('Late soon recognize maybe statement herself later. Three baby though particular drive seven.\nBy street top two in.\nPurpose expect someone seem evidence year. Never sell town country answer win.', 'Property know put rather. Third social return sea.\nTruth race establish page. Girl build improve full stock her herself everyone. Image give stage lead.', 'Attention around certain education behind. Total red same or.\nPractice office popular she over create. Product probably itself sign.');
        $project2->setDate(new DateTime('03/06/1650'));
        $project2->addCategory($this->getReference('category_0'));
        $project2->addCategory($this->getReference('category_1'));
        $project2->addImage($this->getReference('image_1'));
        $manager->persist($project2);

        $project3 = new Project();
        $project3->setTitle('Project 3');
        $project3->setDescription('Late soon recognize maybe statement herself later. Three baby though particular drive seven.\nBy street top two in.\nPurpose expect someone seem evidence year. Never sell town country answer win.', 'Property know put rather. Third social return sea.\nTruth race establish page. Girl build improve full stock her herself everyone. Image give stage lead.', 'Attention around certain education behind. Total red same or.\nPractice office popular she over create. Product probably itself sign.');
        $project3->setDate(new DateTime('01/01/2000'));
        $project3->addCategory($this->getReference('category_2'));
        $project3->addImage($this->getReference('image_2'));
        $manager->persist($project3);

        $project4 = new Project();
        $project4->setTitle('Project 4');
        $project4->setDescription('Cultural after section well. Nation individual seek art discover identify into. Cup at along why main. Very enjoy product effect.', 'Sign actually stop. Reason century market level attention sense physical. Factor movement which discussion.\nWhite vote spring board image expect. Current staff police side.', 'Hear appear religious. Special wife set visit.\nCertainly deep order. Firm strategy ten bad successful special.');
        $project4->setDate(new DateTime('12/12/1979'));
        $project4->addCategory($this->getReference('category_3'));
        $project4->addImage($this->getReference('image_3'));
        $manager->persist($project4);

        $project5 = new Project();
        $project5->setTitle('Project 5');
        $project5->setDescription('Health foreign bank big military. Style minute writer how. Town discover friend look speech avoid hour.', 'Amount me close sit sing body resource. Commercial beyond clearly point start traditional child member. Hot talk experience practice both brother.', 'Political radio vote yet arm friend smile. Audience discuss four show material establish space. Mention money Mrs less people administration enough back.');
        $project5->setDate(new DateTime('06/09/1989'));
        $project5->addCategory($this->getReference('category_2'));
        $project5->addCategory($this->getReference('category_3'));
        $project5->addImage($this->getReference('image_4'));
        $manager->persist($project5);

        $project6 = new Project();
        $project6->setTitle('Project 6');
        $project6->setDescription('Industry anyone ready least hour exist effort. Bad film blood push local. Again particular care approach.\nCenter what majority service among. Face across run. Hard poor two safe range plan.', 'Involve school theory cold institution among here. Above owner plan player season fight. Nothing mouth stand market road second serious meeting.', 'Fall sometimes best drive young situation rest might. And federal majority go yet.\nMusic measure morning get apply. Mission mouth stuff news. Huge about official national sea someone ever.');
        $project6->setDate(new DateTime('11/09/1744'));
        $project6->addCategory($this->getReference('category_0'));
        $project6->addCategory($this->getReference('category_2'));
        $project6->addImage($this->getReference('image_5'));
        $project6->addImage($this->getReference('image_6'));
        $project6->addImage($this->getReference('image_7'));
        $manager->persist($project6);

        $project7 = new Project();
        $project7->setTitle('Project 7');
        $project7->setDescription('Order part close. Hold figure anyone box everything. Federal woman wonder. Together buy hospital invest
        ment not four when.\nDrug effect under free. Soldier room they.', 'Occur course get evening capital investment. Company own build close. Gun keep nearly anyone. Suffer affect four at foot.\nRecently writer tonight red wait ask television onto.', 'Trial relationship drug subject. Decide western picture all laugh. Affect set whose Democrat after.\nMarriage sea put sort. Into former TV record fast.');
        $project7->setDate(new DateTime('12/15/2058'));
        $project7->addCategory($this->getReference('category_1'));
        $project7->addImage($this->getReference('image_8'));
        $project7->addImage($this->getReference('image_9'));
        $manager->persist($project7);

        $project8 = new Project();
        $project8->setTitle('Project 8');
        $project8->setDescription('Order part close. Hold figure anyone box everything. Federal woman wonder. Together buy hospital invest
        ment not four when.\nDrug effect under free. Soldier room they.', 'Occur course get evening capital investment. Company own build close. Gun keep nearly anyone. Suffer affect four at foot.\nRecently writer tonight red wait ask television onto.', 'Trial relationship drug subject. Decide western picture all laugh. Affect set whose Democrat after.\nMarriage sea put sort. Into former TV record fast.');
        $project8->setDate(new DateTime('12/15/2058'));
        $project8->addCategory($this->getReference('category_0'));
        $project8->addCategory($this->getReference('category_1'));
        $project8->addCategory($this->getReference('category_2'));
        $project8->addCategory($this->getReference('category_3'));
        $project8->addCategory($this->getReference('category_4'));
        $project8->addImage($this->getReference('image_10'));
        $project8->addImage($this->getReference('image_11'));
        $project8->addImage($this->getReference('image_12'));
        $project8->addImage($this->getReference('image_13'));
        $manager->persist($project8);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            ImageFixtures::class,
            ];
    }
}
