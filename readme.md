CakePHP Demo Project to Illustrate the Code Completion Issues in PhpStorm
=========================================================================

This is an extremely simple 'application' build with the [CakePHP][1] framework. Its purpose is to illustrate some of
the issues that are currently occurring when developing with JetBrain's [PhpStorm][2].

Current Issues
--------------

CakePHP does a lot of magic loading and in order for an IDE to understand that these var/properties are available we
should use PHPDoc blocks. But even when this is done PhpStorm is not able to do proper code completion.

On (Controller) Objects were `@property` is used one can access the property from the method, where it is listed in the
autocomplete dropdown. However this is where the autocomplete stops, no properties/methods of that object is listed.
When manually completing the code to access this method the Quick/Paramter Info etc works the way it should.

    /**
     * @property Page $Page
     */
    class PageController extends AppController {

        public function index() {
            return $this->Page->find('all');
            //                ^^ problem here
        }
    }

In view files (`*.ctp`) a simmilar problem exists. In those files the `View` model is accesable from the `$this` var.
So we add `* @var $this View`, this enables auto completion to the helpers listed in `/lib/Cake/View/View.php`,
including its properties and methods. (So far so good). But once completed, the line of code is flagged by the
Code Inspector because it can not find the method.

Steps Taken to Reduce Issues
----------------------------

-   Several directories are excluded from the project, in order to remove duplicate class declarations.
    (see `/.idea/cakephpstorm.iml`)

-   Controller, Model and View files use PHPDoc to indicate magic loaded object attributes and methods.

    For example see `/app/Controller/PagesController.php` which uses a `@property Page $Page`,
    and `/app/View/Pages/index.ctp` that uses a `@var $this View` in order to be able to access the Helpers
    (Html, Form and Paginator).

Misc
----

Versions used are CakePHP v2.1.2 and PhpStorm v4.0.1

More info/comments of the [Original Forum Message on JetBrain's PhpStorm/WebStorm Forum][3]

[1]: http://cakephp.org/ "CakePHP"
[2]: http://www.jetbrains.com/phpstorm/ "JetBrain's PhpStorm"
[3]: http://devnet.jetbrains.net/message/5459015#5459015 "Forum Message on Code Completion with PHPDocs"