<?php

namespace BamboV\RutrackerCLI\Commands;

use BamboV\RutrackerAPI\Entities\Options\SearchOptions;
use BamboV\RutrackerAPI\Entities\Options\SortEntity;
use BamboV\RutrackerAPI\Entities\RutrackerTopic;
use BamboV\RutrackerAPI\RutrackerAPI;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Vladimir Barmotin <barmotinvladimir@gmail.com>
 */
class RutrackerSearchCommand extends RutrackerCommand
{
    protected function configure()
    {
        $sortFieldDescription = '';
        foreach(array_keys(RutrackerAPI::FIELDS) as $FIELD){
            $sortFieldDescription.=$FIELD."\n";
        }

        $sortDirectionDescription = '';
        foreach (array_keys(RutrackerAPI::DIRECTIONS) as $DIRECTION) {
            $sortDirectionDescription.=$DIRECTION."\n";
        }

        parent::configure();
        $this->setName('search');
        $this->addArgument('name', InputArgument::REQUIRED);
        $this->addOption('download_first');
        $this->addOption('forum_id', null, InputOption::VALUE_REQUIRED);
        $this->addOption('user_name', null, InputOption::VALUE_REQUIRED);
        $this->addOption('only_open');

        $this->addOption('sort_field', null, InputOption::VALUE_REQUIRED, $sortFieldDescription);
        $this->addOption('sort_direction', null, InputOption::VALUE_REQUIRED, $sortFieldDescription);

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);

        $name = $input->getArgument('name');

        $options = new SearchOptions($name);

        if($forumId = $input->getOption('forum_id')) {
            $options->setForumId($forumId);
        }

        $options->setOnlyOpen($input->getOption('only_open'));

        if($userName = $input->getOption('user_name')) {
            $options->setUserName($userName);
        }

        if($field =$input->getOption('sort_field')) {
            $options->setSort(new SortEntity(
                $field,
                $input->getOption('sort_direction') ? $input->getOption('sort_direction') : 'ASC'
            ));
        }

        $searchResult = $this->rutrackerService->search($options);

        if($input->getOption('download_first')) {
            $this->rutrackerService->downloadTorrentFile($searchResult[0]->getId());
        } else {
            foreach ($searchResult as $item) {
                /** @var RutrackerTopic $item */
                $output->writeln($item->getId() . "\t" . $item->getTheme() . "\t" . $item->getAuthor()->getUserName());
            }
        }
    }

}
