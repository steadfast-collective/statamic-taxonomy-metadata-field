# Statamic Taxonomy Metadata Field

> Statamic Taxonomy Metadata Field is a Statamic addon that does something pretty neat.

## Features

This addon does:

- This
- And this
- And even this

## How to Install

Add the following to your `composer.json`:
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/steadfast-collective/statamic-taxonomy-metadata-field.git" 
    }
]
```
Then run 
```bash
composer require steadfast-collective/statamic-taxonomy-metadata-field
```
## How to Use

Add the "Taxonomy Metadata" field to a blueprint, and specify the taxonomy it relates to.

## Usage within a template
```
{{ field_name }}
    {{ term:title }} # You can access all term properties, using 'term:{property}' 
    {{ data }}
{{ /field_name }}
```
