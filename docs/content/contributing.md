Contributions are welcome, and are accepted via pull requests. Please review these guidelines before submitting any pull requests.

## Guidelines

* Please follow the [PSR-12 Coding Standard](https://www.php-fig.org/psr/psr-12/).
* Ensure that the current tests pass, and if you've added something new, add the tests where relevant.
* Send a coherent commit history, making sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please [squash](http://git-scm.com/book/en/Git-Tools-Rewriting-History) them before submitting.
* You may also need to [rebase](http://git-scm.com/book/en/Git-Branching-Rebasing) to avoid merge conflicts.

## Running Tests

You will need to install [Composer](https://getcomposer.org) before continuing.

First, install the dependencies:

```bash
$ composer install
```

Then run phpunit, phpstan and code sniffer:

```bash
$ composer check
```

If the test suite passes on your local machine you should be good to go.

> *PRO TIP* : Install the git hooks by running `composer githooks`. This will make git run phpunit, phpstan and code sniffer before committing or pushing to remote.

## Documentation

If you are adding a new feature or changing functionalities please also update the proper documentation under the `./docs` folder. We are using [docsify](https://docsify.js.org/) for the docs.