/**
* 2017-2027 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2017-2027 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/

gfonts = []
//AIzaSyC1llvNIdtoIPKl7Z91ksJ9yOAwdPvU6dY

if (configData.settings.google_fonts_key != '') {
  $.get('https://www.googleapis.com/webfonts/v1/webfonts?key=' + configData.settings.google_fonts_key, function (res) {
    res.items.map(function (item) {
      gfonts.push(item.family)
    })
  }).fail(function (err) {
    console.log(err)
  })
}

$(document).ready(function () {
  var globals = {
    showall: false,
    clearcolors: false
  }
  var defaults = {
    line: {
      type: 'color',
      title: '',
      'class': '',
      color: '',
      prop: '',
      description: '',
      h_shadow: '',
      v_shadow: '',
      blur_radius: '',
    },
    fontline: {
      type: 'font',
      title: '',
      'class': '',
      fontfamily: '',
      fontsize: '',
      description: '',
    },
    widthline: {
      type: 'width',
      title: '',
      'class': '',
      width: 'container',
      description: '',
    },
    group: {
      name: '',
      visibility: 'everywhere',
      lines: [],
      sub: []
    }
  }

  Vue.component('cselect', {
    delimiters: ['##', '##'],
    template: '#cselect',
    props: ['value'],
    data: function () {
      return {
        selected: '',
        fonts: gfonts,
        showOpts: false,
        gfonts: gfonts
      }
    },
    methods: {
      onClick: function () {
        this.fonts = JSON.parse(JSON.stringify(gfonts))
        this.showOpts = true
      },
      onOptClick: function () {
        this.showOpts = false
      },
      onInput: function (event) {
        var val = event.target.value
        var regex = new RegExp(val, 'gi')
        this.selected = val
        this.fonts = JSON.parse(JSON.stringify(gfonts))
        this.fonts = this.fonts.filter(function(font) { return regex.test(font) })
      },
      onMouseOver (opt) {
        this.selected = opt
        this.$emit('change', opt)
      }
    },
    mounted: function () {
      var self = this;
      $(window).click(function (event) {
        if (event.target != self.$refs.input && $(event.target).closest(self.$refs.opts).length == 0) {
          self.showOpts = false
        }
      })
      this.selected = this.value
    }
  })

  Vue.component('cline', {
    delimiters: ['##', '##'],
    template: '#cline',
    props: ['line'],
    data: function () {
      return {
        globals: globals,
        labels: configLabels,
        showColorPicker: false,
        colorTypes: ['color', 'backcolor', 'border', 'box', 'svg', 'textshadow'],
        valid: {'class': true, 'color': true, 'title': true},
        show_text_shadow_field: false
      }
    },
    components: {
      colorpicker: VueColor.Chrome
    },
    computed: {
      clearcolors: function () {
        return globals.clearcolors
      },
      colorStyle: function (){
        var color = tinycolor(this.line.color)

        var textColor = (color.isLight()) ? 'black' : 'white'
        return {'background-color': this.line.color, 'color': textColor}
      },
      propStyle: function (){
        return (this.line.type != 'box') ? this.colorStyle : ''
      }
    },
    watch: {
      clearcolors: function (val) {
        this.line.color = ''
        this.line.prop = ''
      }
    },
    methods: {
      changeFont(font) {
        this.line.fontfamily = font
        if (typeof (configData.settings.google_fonts) == 'undefined') {
          configData.settings.google_fonts = {}
        }
        configData.settings.google_fonts[this.line.class] = font
      },
      onUpdateColor: function (color) {
        var c = tinycolor(color.rgba)
        var s = (color.a < 1) ? c.toString() : c.toString('hex')
        this.line.color = s
        if (this.line.type != 'box') {
          this.line.prop = s
        }
      },
      removeLine: function () {
        this.$emit('removeLine', this.line)
      },
      isValid: function (name) {
        return (this.valid[name]) ? '' : 'not-valid'
      },
      validate: function (name, s) {
        switch (name) {
          case 'title':
            return (s !== '') ? '' : 'not-valid'
            break
          case 'class':
            try {
              var $el = $(s);
            } catch(error) {
              return 'not-valid'
            }
            return (s !== '') ? '' : 'not-valid'
            break
          case 'color':
            if (s !== '') {
              var c = tinycolor(s)
              if (!c.isValid()) {
                return 'not-valid'
              }
            }
            return ''
            break
          case 'h_shadow':
            return (s !== '') ? '' : 'not-valid'
            break
          case 'v_shadow':
            return (s !== '') ? '' : 'not-valid'
            break
          case 'blur-radius':
            return (s !== '') ? '' : 'not-valid'
            break
        }
      },
      changedValue: function(value) {
        if (this.line.type == 'textshadow') {
          this.show_text_shadow_field = true;
        } else {
          this.show_text_shadow_field = false;
        }
      }
    },
    mounted: function () {
      if (typeof (this.line.defcolor) != 'undefined') {
        this.line.color = this.line.defcolor
        delete this.line.defcolor
      }

      if (typeof (this.line.defprop) != 'undefined') {
        this.line.prop = this.line.defprop
        delete this.line.defprop
      }

      var self = this;
      $(window).click(function (event) {
        if (event.target != self.$refs.colorinput && $(event.target).closest(self.$refs.colorpicker).length == 0) {
          self.showColorPicker = false
        }
      })
    }
  })

  Vue.component('groups', {
    delimiters: ['##', '##'],
    template: '#groups',
    data: function () {
      return {
        sub: configData.colors,
        globals: globals
      }
    },
    methods: {
      addGroup: function() {
        this.sub.push(JSON.parse(JSON.stringify(defaults.group)))
      },
      removeChildGroup: function(group) {
        var idx = this.sub.indexOf(group)
        this.sub.splice(idx, 1)
      },
      addChildGroups: function(group) {
        var idx = this.sub.indexOf(group)
        this.$set(this.sub[idx], 'sub', [])
      },
      addChildLines: function(group) {
        var idx = this.sub.indexOf(group)
        this.$set(this.sub[idx], 'lines', [])
      }
    }
  })

  Vue.component('switchcomp', {
    delimiters: ['##', '##'],
    template: '#switch',
    props: ['value']
  })

  Vue.component('group', {
    delimiters: ['##', '##'],
    template: '#group',
    props: ['group'],
    data: function () {
      return {
        showLines: false,
        globals: globals,
      }
    },
    computed: {
      showall: function () {
        return globals.showall
      }
    },
    watch: {
      showall: function (val) {
        if (val !== null) {
          this.showLines = this.showall
        }
      }
    },
    methods: {
      showToggle: function () {
        this.globals.showall = null
        this.showLines = !this.showLines
      },
      addGroup: function() {
        this.globals.showall = null
        this.showLines = true
        this.group.sub.push(JSON.parse(JSON.stringify(defaults.group)))
      },
      addColor: function() {
        this.globals.showall = null
        this.showLines = true
        this.group.lines.push(JSON.parse(JSON.stringify(defaults.line)))
      },
      addFont: function() {
        this.globals.showall = null
        this.showLines = true
        this.group.lines.push(JSON.parse(JSON.stringify(defaults.fontline)))
      },
      addWidth: function() {
        this.globals.showall = null
        this.showLines = true
        this.group.lines.push(JSON.parse(JSON.stringify(defaults.widthline)))
      },
      removeGroup: function() {
        this.$emit('removeGroup', this.group)
      },
      removeChildGroup: function(group) {
        var idx = this.group.sub.indexOf(group)
        this.group.sub.splice(idx, 1)
      },
      addChildGroups: function(group) {
        var idx = this.group.sub.indexOf(group)
        this.$set(this.group.sub[idx], 'sub', [])
      },
      addChildLines: function(group) {
        var idx = this.group.sub.indexOf(group)
        this.$set(this.group.sub[idx], 'lines', [])
      },
      removeLine: function(line) {
        var idx = this.group.lines.indexOf(line)
        this.group.lines.splice(idx, 1)
      }
    },
    mounted: function () {
      if (typeof (this.group.sub) == 'undefined') {
        this.$emit('addGroups')
      }
      if (typeof (this.group.lines) == 'undefined') {
        this.$emit('addLines')
      }
      if (typeof (this.group.visibility) == 'undefined') {
        this.$set(this.group, 'visibility', 'everywhere')
      }
    }
  })

  Vue.component('save', {
    delimiters: ['##', '##'],
    template: '#save-component',
    props: ['link'],
    data: function () {
      return {
        buttonState: {
          'disable': false
        },
        iconState: 'process-icon-save'
      }
    },
    methods: {
      save: function () {
        var that = this
        this.buttonState.disabled = true
        this.iconState = 'process-icon-loading'
        this.$emit('beforesave')
      }
    },
  })



  app = new Vue({
    el: '#vue-app',
    delimiters: ['##', '##'],
    data: function () {
      return {
        savesuccess: false,
        saveerror: false,
        reqerror: false,
        googleerror: false,
        onsave: false,
        settings: configData.settings,
        demo: configData.settings.demo
      }
    },
    mounted: function () {
      var setNames = ['width', 'menu_class', 'shadow_classes', 'radius_classes', 'container_class', 'google_fonts_key']
      var switches = ['frontpanel', 'demo', 'fixedmenu', 'borderradius', 'boxshadow']
      var self = this
      setNames.map(function (name) {
        if (typeof(self.settings[name]) == 'undefined') {
          self.$set(self.settings, name, '')
        }
      })
      switches.map(function (name) {
        if (typeof(self.settings[name]) == 'undefined') {
          self.$set(self.settings, name, 1)
        }
      })
    },
    methods: {
      onGoogleKeyChange: function () {
        this.googleerror = false
        var self = this
        if (this.settings.google_fonts_key != '') {
          $.get('https://www.googleapis.com/webfonts/v1/webfonts?key=' + this.settings.google_fonts_key, function (res) {
            if (typeof (res.items) != 'undefined') {
              res.items.map(function (item) {
                gfonts.push(item.family)
              })
              return
            }
            self.googleerror = true
          }).fail(function (err) {
            console.log(err.responseJSON)
            self.googleerror = true
          })
        }
      },
      beforeSave: function () {
      },
      save: function (res) {
        var self = this

        this.savesuccess = false
        this.saveerror = false
        this.reqerror = false
        if ($('.colorconfigurator .not-valid').length) {
          this.reqerror = true
          globals.showall = true
          return
        }
        this.onsave = true
        $.post(saveLink, {data: configData}, function (res) {
          res = JSON.parse(res)
          self.onsave = false
          if (res.success === true) {
            self.savesuccess = true
            self.demo = configData.settings.demo
          } else {
            self.saveerror = true
          }
        }).fail(function (err) {
          self.saveerror = true
        })
      }
    }
  })

	$('.colorconfigurator').on('change' , '#colors_data', function(){
		if ($(this).val() != '') {
			$(this).parent().find('span').text($(this).val());
			$(this).parent().parent().find('#submit-upload').prop('disabled', false);
		}
	});
})

var app = null
