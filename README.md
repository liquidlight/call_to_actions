# Call to Actions

_This readme is **very much** in draft and needs to be written properly

# To Do

- Create proper TYPO documentation
- Make the plugin appear in the wizard in version 10
- Add new icon


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
