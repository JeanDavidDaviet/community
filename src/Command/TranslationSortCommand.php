<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Yaml\Yaml;

#[AsCommand(
    name: 'translation:sort',
    description: 'Sort the translations by key in a yaml file',
)]
class TranslationSortCommand extends Command
{
    public function __construct(private string $project_dir, private Yaml $yaml)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        // $this
        //     ->addArgument('path', InputArgument::OPTIONAL, 'Path to the file to process')
        //     ->addOption('force', false, InputOption::VALUE_NONE, 'Option description')
        // ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        // $path = $input->getArgument('path');

        // if ($path) {
        //     $io->note(sprintf('You passed an argument: %s', $path));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        $yamlFile = $this->project_dir. '/translations/messages.fr.yaml';
        $yamlContent = $this->yaml::parseFile($yamlFile, Yaml::PARSE_CONSTANT);
        ksort($yamlContent, SORT_NATURAL);
        $yamlNewContent = $this->yaml::dump($yamlContent);
        file_put_contents($yamlFile, $yamlNewContent);
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
