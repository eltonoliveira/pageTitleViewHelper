# pageTitleViewHelper

Set the page title on Zend Framework 2 apps.

Installation
------------

1. Add this helper in your `Module.php`:

    ```php
    <?php
        namespace Application;

        class Module
        {
            public function getViewHelperConfig()
            {
                return array(
                    'invokables' => array(
                        'pageTitle' => 'Application\View\Helper\PageTitle'
                    )
                );
            }
        }
    ```
    
2. Create `page_titles.global.php` file:
 
    ```php
    <?php

        return array
            'page_title' => array(
                // 'user' is controller name
                'user' => array(
                    // 'index' and 'show' is action name
                    'index' => 'Usuários',
                    'new' => 'Adicionar novo usuário'
                )
            )
        );

    ```
    
3. Use the helper pageTitle in your view:

    ```html
        <div class="page-header">
            <h1>
                <?php echo $this->pageTitle(); ?>
            </h1>
        </div>
    ```
    
## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request
