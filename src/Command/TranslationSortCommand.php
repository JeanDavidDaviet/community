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
        $this
            ->addOption('file', 'f', InputOption::VALUE_NONE, 'The file to sort')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        // $path = $input->getArgument('path');

        // if ($path) {
        //     $io->note(sprintf('You passed an argument: %s', $path));
        // }

        $files_path = $this->project_dir. '/translations';

        if ($input->getOption('file')) {
            $file = $input->getOption('file');
        }

        if (isset($file)) {
            $this->parseFile($file);
        } else {
            $files = array_filter(scandir($files_path), function ($path) {
                return pathinfo($path)['extension'] === 'yaml';
            });
            foreach ($files as $file) {
                $this->parseFile($files_path . DIRECTORY_SEPARATOR . $file);
            }
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }

    private function parseFile(string $file): int|false
    {
        $parsedYaml = $this->yaml::parseFile($file, Yaml::PARSE_CONSTANT);
        ksort($parsedYaml, SORT_NATURAL);
        $yamlDump = $this->yaml::dump($parsedYaml);
        return file_put_contents($file, $yamlDump);
    }
}
