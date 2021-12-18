<?php

namespace App\Service;

use App\Repository\PageRepository;

class GetAllPages
{
    protected PageRepository $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function getPages()
    {
        $pages = $this->pageRepository->findAll();
        $groups = [
            [
                'title' => '',
                'pages' => []
            ]
        ];

        foreach ($pages as $page) {
            $group = $page->getPageGroup();
            if ($group) {
                $group_slug = $group->getSlug();
                $group_title = $group->getTitle();
                if (!array_key_exists($group_slug, $groups)) {
                    $groups[$group_slug] = [
                        'title' => $group_title,
                        'pages' => []
                    ];
                }
                $groups[$group_slug]['pages'][] = $page;
            } else {
                $groups[0]['pages'][] = $page;
            }
        }

        return $groups;
    }
}
