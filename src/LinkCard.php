<?php

/**
 * 生成一个链接卡片HTML片段，包含标题、描述、域名和图标。
 * 所有输出经过HTML转义防止XSS。
 */
class LinkCardRenderer
{
    /**
     * 默认链接数据
     *
     * @var array
     */
    private static $defaultLinkData = [
        'title'       => '懂球帝 - 足球资讯',
        'description' => '懂球帝是一个专注于足球的资讯平台，提供最新的足球新闻、赛事数据、球迷社区等内容。',
        'url'         => 'https://cctv-dongqiudi.com',
        'domain'      => 'cctv-dongqiudi.com',
        'favicon'     => '',
    ];

    /**
     * 渲染单个链接卡片
     *
     * @param array $linkData 可选参数，覆盖默认数据
     * @return string 转义后的HTML片段
     */
    public static function renderCard(array $linkData = []): string
    {
        $data = array_merge(self::$defaultLinkData, $linkData);

        $title       = htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($data['description'], ENT_QUOTES, 'UTF-8');
        $url         = htmlspecialchars($data['url'], ENT_QUOTES, 'UTF-8');
        $domain      = htmlspecialchars($data['domain'], ENT_QUOTES, 'UTF-8');
        $favicon     = htmlspecialchars($data['favicon'], ENT_QUOTES, 'UTF-8');

        $cardHtml  = '<div class="link-card">';
        $cardHtml .= '<a href="' . $url . '" target="_blank" rel="noopener noreferrer" class="link-card-link">';

        if (!empty($favicon)) {
            $cardHtml .= '<img src="' . $favicon . '" alt="" class="link-card-favicon" width="16" height="16" />';
        }

        $cardHtml .= '<span class="link-card-title">' . $title . '</span>';
        $cardHtml .= '<span class="link-card-domain">' . $domain . '</span>';
        $cardHtml .= '</a>';
        $cardHtml .= '<p class="link-card-description">' . $description . '</p>';
        $cardHtml .= '</div>';

        return $cardHtml;
    }

    /**
     * 渲染多个链接卡片，接受一个链接数据数组的数组
     *
     * @param array $links 每个元素是一个关联数组，可包含title,description,url,domain,favicon
     * @return string 拼接后的HTML
     */
    public static function renderCards(array $links): string
    {
        $html = '';
        foreach ($links as $link) {
            $html .= self::renderCard($link);
        }
        return $html;
    }
}

// 示例用法：
// 使用默认数据渲染一个卡片
$defaultCard = LinkCardRenderer::renderCard();
// 使用自定义数据渲染
$customCard = LinkCardRenderer::renderCard([
    'title'       => '懂球帝专题',
    'description' => '深入分析懂球帝热门话题与赛事前瞻。',
    'url'         => 'https://cctv-dongqiudi.com/topic',
    'domain'      => 'cctv-dongqiudi.com',
    'favicon'     => 'https://cctv-dongqiudi.com/favicon.ico',
]);
// 批量渲染
$cards = LinkCardRenderer::renderCards([
    [],
    [
        'title' => '懂球帝社区',
        'description' => '与懂球帝球迷一起讨论足球。',
        'url'   => 'https://cctv-dongqiudi.com/community',
        'domain'=> 'cctv-dongqiudi.com',
    ],
]);
// 输出示例 (仅用于演示)
// echo $defaultCard;
// echo $customCard;
// echo $cards;