# Emoji
<img src="./asset/icon.jpg">
pmmp emoji plugin

## how to use
1. Download [EmojiParticle.mcpack](https://github.com/sky-min/Emoji/raw/master/resourcepack/EmojiParticle.mcpack) and put it in the resource_packs folder.
2. Open file `resource_packs.yml`, set **force_resources** to `true` and resource_stack to `EmojiParticle.mcpack`.
```yaml
force_resources: true
resource_stack:
  - EmojiParticle.mcpack
```
3. Apply this plugin
4. Enjoy it with /emoji command

# API
```php
/**
 * @var $entity Entity
 * @see $emojiId Emoji::EMOJI_LIST
 */
Emoji::sendEmoji($entity, $emojiId);
```