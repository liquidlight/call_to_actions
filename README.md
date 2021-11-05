# Call to Actions

_This readme is **very much** in draft and needs to be written properly

# To Do

- Write readme
  - Configuration of templates
  - Configuration of theme & types
- Create proper TYPO documentation
- Make the plugin appear in the wizard in version 10


## Installation

```
composer req liquidlight/call-to-actions
```

## Usage

1. Install extension
2. Decide where CTAs are going to live
3. Add a new call to action
  - Labels are only used internally
  - Theme and Type is used for CSS styling, however you could use fluid conditionals to change the display & layout
  - Buttons are only shown if link text & url are filled in
  - Image is rendered at the top (but can be changed with a template)
4. Go to the page where you want to display the CTA
5. Create a new Call to Actions plugin
6. Use the records field to navigate to the directory containing the CTAs and add the one(s) you wish to display
7. Save, close and view

## Customisation

### Templates

If you wish to override the `Templates` or `Partials`, add the following to your `constants`

```
site.fluidtemplate.call_to_actions {
	templateRootPath =
	partialRootPath =
}
```

From there you can include the files you wish to replace

## Types & Themes

If you wish to change or add to the Theme and Types dropdowns, you can do this via Typoscript

Add the following to `setup`

```
tt_content.call_to_actions {
	classes {
		type {
			0 {
				title = Simple
				value = simple
			}
			1 {
				title = Featured
				value = featured
			}
		}

		theme {
			0 {
				title = Light
				value = light
			}
			1 {
				title = Dark
				value = dark
			}
		}
	}
```

The numbers are indexes - if you wish to replace one use the same index, however if you only want to add then you can include just that one with an incremental number

`title` is what is shown in the drop down, while `value` is what is output in the template.

e.g.

```
tt_content.call_to_actions {
	classes.type {
		2 {
			title = Highlight
			value = highlightCTA
		}
	}
}
```
