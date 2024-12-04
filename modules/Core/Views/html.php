<!DOCTYPE html>
<html lang="ko-KR">
    <head <?php echo core_services_html()->getAttribute('head'); ?>>
        <?php
        // set tag
        foreach (core_services_html()->getTag() as $tag)
        {
            echo $tag . PHP_EOL;
        }
        ?>

        <title><?php echo core_services_html()->getTitle(); ?></title>

        <?php
        // set css
        foreach (core_services_html()->getCss() as $css)
        {
            echo $css . PHP_EOL;
        }
        ?>

        <?php
        // set javascript header
        foreach (core_services_html()->getJs('header') as $js)
        {
            echo $js . PHP_EOL;
        }
        ?>
    </head>
    <body <?php echo core_services_html()->getAttribute('body'); ?>>
        <?php echo $layout ?? ''; ?>

        <?php
        // set javascript footer
        foreach (core_services_html()->getJs() as $js)
        {
            echo $js . PHP_EOL;
        }
        ?>
    </body>
</html>
