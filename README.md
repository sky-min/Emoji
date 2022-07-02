# Emoji
<img src="./EmojiPlugin/icon.png">
pmmp emoji plugin

## General
Express your feelings with emojis.

## Note
This plugin needs a resource pack and applies it automatically. At this point, the force_resources value changes to true.

## How to use 
1. Apply this plugin
2. Edit the config.yml file of plugin in plugin_data/emoji
3, you can customize name for emoji
4. Select an emoji via the /emoji command

## API
```php
/**
 * @var $entity Entity
 */
Emoji::getInstance()->sendEmoji($entity, $emojiId);
```
