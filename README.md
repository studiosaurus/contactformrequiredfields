# Contact Form Required Fields plugin for Craft CMS

Adds required fields to Pixel and Tonic’s Contact Form Plugin (https://github.com/pixelandtonic/ContactForm)

## Installation

To install Contact Form Required Fields, follow these steps:

1. Download & unzip the file and place the `contactformrequiredfields` directory into your `craft/plugins` directory
2.  -OR- do a `git clone git@github.com:Studiosaurus/contactformrequiredfields.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3. Install plugin in the Craft Control Panel under Settings > Plugins
4. The plugin folder should be named `contactformrequirements` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

Contact Form Required Fields works on Craft 2.4.x and Craft 2.5.x.

## Using Contact Form Required Fields

Contact Form Required Fields using Contact Form’s `onBeforeSend` event to check for required fields on a Form entry. The entry’s id must be included in the posted variables as `formId` and hashed.

The plugin expects the entry to have a Matrix field with a `fieldBlocks` handle and each required block to have a `label` field that’s used as the `message` key when submitted with the form (i.e. `<input type="text" name="message[field.label]"`) and a `required` field that’s a Lightswitch.

In this plugin’s current state, it isn’t flexible, so it’s probably best to use it as an example and modify to fit your needs.

## Contact Form Required Fields Roadmap

Some things to do, and ideas for potential features:

* Add configuration options
* Check for custom error messages on required fields

## Contact Form Required Fields Changelog

### 1.0.0. -- 2016.04.25

* Initial release

Brought to you by [Stephen Bowling](https://stephenbowling.com)
