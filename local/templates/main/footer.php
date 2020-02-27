<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<footer class="main-footer">
    <div class="container main-footer__content">
        <div class="row align-items-center">
            <div class="col-4">
                <div class="footer-logo"><a href="http://www.rushydro.ru/"><img src="<?= SITE_TEMPLATE_PATH?>/assets/images/logo-footer.png" alt=""></a></div>
            </div>
            <div class="col-4">
                <div class="footer-banner footer-banner--1"><?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "local/include/footer_column_1.php"
                        )
                    );?></div>
            </div>
            <div class="col-4">
                <div class="footer-banner footer-banner--2"><?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "local/include/footer_column_2.php"
                        )
                    );?></div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>