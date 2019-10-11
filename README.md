<!-- Graphics or Logo-->

<a href="#"><img src="https://static.thenounproject.com/png/1079634-200.png" title="FVCproductions" alt="Hackpanel"></a>

<!-- Title and slug-->

# Hackpanel: API and Client for Hacks/Bybass creators

> Hackpanel provides fast and easy way for Hacks/Bybass creators to control access to their apps using keys and [HWID](https://geologismiki.gr/Documents/How%20does%20registration%20work.pdf).
> to help them focus more on creating awesome hacks!

<br>

**_Screenshots of the admin panel_**

[![Screenshot1](/media/screenshot1.png)]()

<br>

[![Screenshot1](/media/screenshot2.png)]()

<br>

**_Screenshots of the simple clinet_**

[![Screenshot1](/media/screenshot3.png)]()

<br>

[![Screenshot1](/media/screenshot4.png)]()

---

## Table of Contents

- [Introduction](#introduction)
  - [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Documentation](#documentation)
  - [API](#api)
  - [Client](#client)
- [Special Note](#special-note-dont-read-it-out-load)
- [Special Special Note](#okay-what-next)
- [Contributing](#contributing)
- [Built Using](#built-using)
- [Todo List](#todo-list)
- [License](#license)

---

## Introduction

This project aims to make it easier and faster for hack/bybass creators to control and manage access to their products, while focus more on creating the product itself.

## The Story

I've got the idea when a One of my friends who was a **PUBG bybass creator** with such experience in C++ and **Zero** experience in APIs and Web, asked me to make a very simple key-based login system for his .Net Client.

## Features

- Easy to use UI
- .NET client example
- Manage Multiple apps
- Key-locked HWID (**H**ard**w**are **ID**)

---

## Installation

### Clone

> Clone this repo to your local machine using

```Bash
git clone link
```

### Setup

> For Development

```Bash
composer install
composer dump-autoload
php artisan key:generate
php artisan migrate --seed
php artisan passport:install
```

## Client

navigate to Client Repo

---

## Usage

- Login as
  - email: admin@admin.com
  - password: admin
- Follow The [documentation](#documentation)

## Documentation

First things first you need to request an **Bearer Access Token** for the client.

`POST http://localhost:8000/oauth/token`

Request Body

**grant_type**: password

**client_id**: 2

**client_secret**: use this command to generate a new client secret `php artisan passport:install`

**username**: admin@admin.com

**password**: admin

## API

### Login using Key

`POST http://localhost:8000/api/keyLogin`

Request Body

**Key**, **Example**: HAKPNLQJJJPSPZZVF72Y

**[hwid]**: optional if the key is only for one PC, Clinet will generate it in the first successful login.

**Example**: E5A9-1724-3D5F-1E48-E6B1-A98A-9B98-DDD6

**access_token**: send with every login request to id the app.

**Example**:wBXMGfw1GSsgzpUdTSBaW55ttp7vVCZ9QVmWis6xXiVbYBEPkOILLS3zrPeU

---

### Fetching data

using laravel awesome [Route::resource()](https://laravel.com/docs/5.7/controllers) you can get all possible routes using this command `php artisan route:list`

## Client

Hackpanel example .net client handles every request using **ApiHandler.cs** library.

```c#
public ApiHandler(string apiToken, string appToken, string apiUrl);
```

**apiToken**: Bearer Access Token

**appToken**: App access token

**apiUrl**: your-url.com/api

### send POST request

```c#
 public dynamic post(string url, Dictionary<string, object> data);
```

### GET POST request

```c#
    public dynamic get(string url);
```

#### Some helper methods

```C#
    #get current app info in dictionary key-value pair
    public Dictionary<string, object> pairAppInfo();

    #get current app meta info in dictionary key-value pair
    public Dictionary<string, object> pairAllMeta();

    #login using key
    public Dictionary<string, object> Login(string key, string hwid, string token);

```

---

## Special Note (Don't Read It Out Load!)

> I don't have time for this, [Skip to the important part](#okay-what-next)!

Okay, one more thing before getting your hammer and start hammering on this little boy ;) that violates every OOP principle out there with poor documentation and low quality code.

Surprisingly! this little boy taught me a lot and I mean a lot, here is a list of what I learnt and what I'll continue to learn along the way of making America great again:

### Writing (supposedly) a good Readme

- **Markdown**: I have been using Laravel packages for a quite a while now realizing how is important is a good readme, so I had to learn [Markdown syntax](https://guides.github.com/features/mastering-markdown/) and tools. what brings us to the second point.

- [**VSCode**](https://code.visualstudio.com/): I been [sublime text](https://www.sublimetext.com/) die-hard fan for a while, there's a tendency in the developers community to migrate to [**VSCode**](https://code.visualstudio.com/), but I sticked with [sublime text](https://www.sublimetext.com/) anyway, until I stumbled on [Markdown tutorial](https://www.youtube.com/watch?v=HUBNt18RFbo) which used a [markdown-all-in-one](https://marketplace.visualstudio.com/items?itemName=yzhang.markdown-all-in-one) and [markdown review](https://code.visualstudio.com/docs/languages/markdown) extensions, since then I stated to use VSCode more.

### Was it worth learning a new language!

- **C#**: example .NET client took me 60 long hours of hard debugging [.Net JSON](https://www.newtonsoft.com/) tokens, [Dictionaries](https://docs.microsoft.com/en-us/dotnet/api/system.collections.generic.dictionary-2) and remembering that C# arrays doesn't behave as php arrays,scrolling in stackOverflow threads and documentations to just to know how to [initialize a damn dictionary](https://stackoverflow.com/questions/17047602/proper-way-to-initialize-a-c-sharp-dictionary-with-values) ;).

- **New Package manager**: C# [Nuget](https://www.nuget.org/).

### New Tools

- [**Postman**](https://www.getpostman.com/): Fun transition from boring `Console.WriteLine();` debugging APIs responses using REST Client.

- **Code Generators**: In the beginning I created every controller, model, view, transformer...etc manually, it was time consuming and duplicated code, I found the magic pill [InfyOmLabs's](https://github.com/InfyOmLabs) [Laravel Code Generator](https://github.com/InfyOmLabs/laravel-generator).

- [**Datatables**](https://github.com/yajra/laravel-datatables): Handling Datatables was a challenge after countless sleepless trail and error nights I learned that [Laravel Code Generator](https://github.com/InfyOmLabs/laravel-generator) is way cleaner and efficient.

- **[PHPCS](https://github.com/squizlabs/PHP_CodeSniffer) and [PSR](https://www.php-fig.org/psr/)**: Code standardization is a great deal in open source community, that I noticed some packages or even Laravel repo itself includes .phpcs which led me to the new world of PHP PSR, code standards, and prettify which by the way wasn't easy to configure.

- [**PHP DocBlocks**](https://docs.phpdoc.org/guides/docblocks.html): Above every function there's a comment block that explains what it does right! but I didn't know it can [generate a full api reference](https://github.com/gossi/docblock)!

### Git and Github Collaboration

- I was solo old-school type developer since the beginning, one simple thing as deploying this project to [DigitalOcean](https://www.digitalocean.com/) Droplet inspire me to learn Git just to use **[post-push-hook](https://git-scm.com/book/en/v2/Customizing-Git-Git-Hooks)**, then share this project, my thoughts and ideas with the community is a great opportunity to **git** more familiar with github.

### Server Management

- **[DigitalOcean](https://www.digitalocean.com/)**: I'm a windows user, One of my favorite cloud hosting ever, browsing it's great detailed [documentation](https://www.digitalocean.com/docs/) helped me a lot to understand linux, apt, and some Nginx configurations.

## Okay, What Next

**I'm a believer of [learning by example](https://experiencelife.com/article/learning-by-example/) best way to learn anything is to know how it works then doit yourself so, this project was good chance to help friend run his illegitimate business :) then turned it into a learning journey where every step is an adventure itself, which wanted to share and inspire others like me who want some motivation, roadmap and cup of coffee to get things moving. so, what do I need from you? Please read [Contributing](#contributing) section.**

---

## Contributing

To all of those who wanted to get involved this journey of learning and make america great again.

> To get started...

### Step 1

- Take a quick look on [Todo List](#todo)
- Open issue to share and discuses new ideas or features.

### Step 2

- **Option 1**
  - Fork this repo!
  
- **Option 2**
  - Clone this repo to your local machine using `git clone https://github.com/joanaz/HireDot2.git`

### Step 3

- **Do your thing, Hackaway.**

### Step 4

- Create a new pull request using <https://github.com/joanaz/HireDot2/compare>

---

### What's hides in the future

- **Learn how to write [unit tests](https://phpunit.de/)**
- **Generate API Docs**
- **Apply some [OOP principles](https://medium.com/@cancerian0684/what-are-four-basic-principles-of-object-oriented-programming-645af8b43727)**

## Todo List

- [ ] Refactor the Key Login system into it's own package.
- [ ] Implement Roles and permission.
- [ ] Implement Multiple deletes in datatables.
- [ ] Webhooks support.
- [ ] Implement downloadable files.
- [ ] Simple CMS to manage index page.
- [ ] Rewrite API code base from scratch.
- [ ] Rewrite example Client code base from scratch.
- [ ] Apply some OOP principle.
- [ ] Write Unit tests
- [ ] Write DocBlocks
- [ ] Rewrite this Readme File

---

## Built Using

- [Laravel](https://laravel.com/)
- [Infyom Laravel Generator](http://labs.infyom.com/)
- [AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE)
- [Yajra DataTables](https://github.com/yajra/laravel-datatables)

---

## License

[![License](http://img.shields.io/:license-mit-blue.svg?style=flat-square)](http://badges.mit-license.org)
