# school_code-on_fatfree
This project learning code on framework fat free. To create a private archive of useful scripts. 
To then easily incorporate small blocks into the finished project.


## INSTALL
### GIT
> $ git clone https://github.com/born-kes/school_code-on_fatfree.git

### Download File 

> https://github.com/born-kes/school_code-on_fatfree/archive/master.zip

## NEXT

create a folder src and run commends

> composer install

if you don't have composer first install 
You can download it
> git clone https://born-kes@bitbucket.org/born-kes/composer.git

next you reflesh autoload
> composer dump-autoload

## Run test

If you looking test list, look in *composer.json*, section *scripts*.
You see test list and commands

Run all tests with this command
> composer test

# Semantic Commit Messages
Format: `<type>(<scope>): <subject>`
```
[optional] <body>

[optional] <footer(s)>
```

## More Examples:


- `feat`: (new feature for the user, not a new feature for build script)
- `fix`: (bug fix for the user, not a fix to a build script)
- `docs`: (changes to the documentation)
- `style`: (formatting, missing semi colons, etc; no production code change)
- `refactor`: (refactoring production code, eg. renaming a variable)
- `test`: (adding missing tests, refactoring tests; no production code change)
- `perf`: A code change that improves performance
- `build`: Changes that affect the build system or external dependencies (example scopes: gulp, broccoli, npm)
- `chore`: (updating grunt tasks etc; no production code change)
 
### scope
- `add`
- `remove`
- `rename`
- `middleware`
- `init`
- `runner`
- `watcher`
- `config`
- `web-server`
- `proxy`

### footer
- `Fixes` fix | fixes | fixed
- `Closes` close | closes | closed
- `resolves` resolve | resolves | resolved
 `#issue` 