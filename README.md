# pageTitleViewHelper

Set the page title on Zend Framework 2 apps.

Usage
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

2. Set your controller in  `module.config.php` file:
    ```php
    <?php
    
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Dashboard' => 'Application\Controller\DashboardController',
        ),
    ),
    ```
    
3. Create `page_titles.global.php` file:
    ```php
    <?php
    
    return array
        'page_title' => array(
            // controller name
            'Application\Controller\Dashboard' => array(
                'index' => 'Dashboard'
            )
        )
    );
    ```
    
4. Use the helper pageTitle in your view:

    ```html
    <div class="page-header">
        <h1>
            <?php echo $this->pageTitle(); ?>
        </h1>
    </div>
    ```
    
To display the page title in the title header, make sure that your `layout.phtml` is using `headerTitle()` helper:
    
```html
<?php echo $this->doctype(); ?>
    
<html lang="en">
    <head>
        <?php echo $this->headTitle('Acme Inc.')->setSeparator(' :: ')->setAutoEscape(false) ?>
    </head>
```
    
## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request
