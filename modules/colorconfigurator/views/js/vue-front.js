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
function getStyle(className, propName, prop) {
  var styleSheets = window.document.styleSheets;
  var styleSheetsLength = styleSheets.length;
  className = className.replace(/\s/g, '')
  className = className.replace(/:/g, '')
  for(var i = 0; i < styleSheetsLength; i++){
    try {
      var classes =  styleSheets[i].cssRules || styleSheets[i].rules;
      var sheet = styleSheets[i]
      if (!classes)
        continue;
      var classesLength = classes.length;
      for (var x = 0; x < classesLength; x++) {
        if (typeof(classes[x].selectorText) == 'undefined') {
          continue
        }
        var selectorText = classes[x].selectorText.replace(/\s/g, '')
        selectorText = selectorText.replace(/:/g, '')
        if (selectorText == className && classes[x].style[propName] == prop ) {
          return {sheet: sheet, idx: x}
        }
      }
    } catch (err) {
    }
  }
}

var gfonts = [];
//AIzaSyC1llvNIdtoIPKl7Z91ksJ9yOAwdPvU6dY
if (colorConfigData.settings.google_fonts_key != '') {
  $.get('https://www.googleapis.com/webfonts/v1/webfonts?key=' + colorConfigData.settings.google_fonts_key, function (res) {
    gfonts.push.apply(gfonts, res.items);
  }).fail(function (err) {
    console.log(err)
  })
}

$(document).ready(function () {

  var sheet = (function() {
    var style = document.createElement("style");
    style.appendChild(document.createTextNode(""));
    document.body.appendChild(style);
    return style.sheet;
  })();

  var colorForCopy = '';

  Vue.component('lang', {
    delimiters: ['##', '##'],
    template: '#language',
    props: ['s']
  });

  Vue.component('switch-component', {
    delimiters: ['##', '##'],
    template: '#switch',
    props: ['value', 'options', 'label', 'cls'],
    data: function () {
      return {
      }
    },
    methods: {
      getActiveClass: function(opt) {
        return (opt == this.value) ? 'active' : ''
      }
    }
  })

  Vue.component('group', {
    delimiters: ['##', '##'],
    template: '#group',
    props: ['group'],
    data: function () {
      return {
        showLines: false,
        hidden: false
      }
    },
    computed: {
      groupToggle: function () {
        return (this.showLines) ? 'icon-minus' : 'icon-plus'
      }
    },
    methods: {
      changeLine(line) {
        this.$emit('activeline', line)
        this.$emit('changeline', line)
      },
      searchInGroup: function (query) {
        if (typeof(this.$refs.group) !== 'undefined') {
          this.$refs.group.map(function(group) {
            group.searchInGroup(query)
          })
        }
        if (typeof(this.$refs.cline) !== 'undefined') {
          this.$refs.cline.map(function(line) {
            line.hidden = false
            var selector = line.class.replace(/:hover/g, '')
            selector = selector.replace(/:active/g, '')
            selector = selector.replace(/:focus/g, '')
            selector = selector.replace(/:before/g, '')
            selector = selector.replace(/:after/g, '')
            if ($(selector).length == 0) {
              line.hidden = true
            }
            if (line.class.indexOf(query) < 0) {
              line.hidden = true
            }
          })
        }
        this.checkVisibility()
      },
      showAllToggle: function (show) {
        if (typeof(this.$refs.group) !== 'undefined') {
          this.$refs.group.map(function(group) {
            group.showAllToggle(show)
          })
        }
        this.showLines = show
      },
      onChildHide: function () {
        this.checkVisibility()
      },
      checkVisibility: function () {
        var hidden_lines = 0
        var hidden_groups = 0
        if (typeof (this.$refs.cline) != 'undefined') {
          hidden_lines = this.$refs.cline.filter(function(l) { return l.hidden == true }).length
        }
        if (typeof (this.$refs.group) != 'undefined') {
          hidden_groups = this.$refs.group.filter(function(g) { return g.hidden == true }).length
        }
        if (
            ((typeof (this.$refs.cline) == 'undefined' || hidden_lines == this.$refs.cline.length) &&
            (typeof (this.$refs.group) == 'undefined' || hidden_groups == this.$refs.group.length)) ||
            ((this.group.visibility != 'everywhere' && this.group.visibility != colorConfigData.settings.php_self) ||
             typeof(this.group) == 'undefined')
          ) {
          this.hidden = true
        } else {
          this.hidden = false
        }
        this.$emit('onhide')
        this.$forceUpdate()
      }
    },
    mounted: function () {
      this.checkVisibility()
    },
    updated: function () {
      // this.checkVisibility()
    }
  })

  Vue.component('cselect', {
    delimiters: ['##', '##'],
    template: '#cselect',
    props: ['value'],
    data: function () {
      return {
        selected: '',
        fonts: gfonts,
        gfonts: gfonts,
        showOpts: false,
      }
    },
    methods: {
      onClick: function () {
        //debugger;
        this.fonts = gfonts.slice();// JSON.parse(JSON.stringify(gfonts))
        this.showOpts = true
      },
      onOptClick: function () {
        this.showOpts = false
      },
      onInput: function (event) {
        var val = event.target.value
        var regex = new RegExp(val, 'gi')
        this.selected = val;
        // this.fonts = gfonts.slice(); //JSON.parse(JSON.stringify(gfonts))
        if(val === ''){
          this.fonts = gfonts.slice();
        }else{
         this.fonts = this.fonts.filter(function(font) { return regex.test(font.family) })
        }
      },
      onMouseOver: function (opt) {
        this.selected = opt
        this.$emit('change', opt)
      }
    },
    mounted: function () {
      this.selected = this.value
      var self = this;
      $(document).click(function (event) {
        if (event.target != self.$refs.input && $(event.target).closest(self.$refs.opts).length == 0) {
          self.showOpts = false
        }
      })
    }
  })

  Vue.component('cline', {
    delimiters: ['##', '##'],
    template: '#cline',
    props: ['line'],
    data: function () {
      return {
        showColorPicker: false,
        idx: 0,
        props: {color: 'color', backcolor: 'backgroundColor', border: 'borderColor', box: 'boxShadow', svg: 'fill', textshadow: 'textShadow'},
        colorTypes: ['color', 'backcolor', 'border', 'box', 'svg', 'textshadow'],
        hidden: false
      }
    },
    computed: {
      class: function () {
        return this.line.class
      },
      property: function () {
        return this.line.prop
      },
      fontfamily: function () {
        return this.line.fontfamily
      },
      fontsize: function () {
        return this.line.fontsize
      }
    },
    watch: {
      hidden: function (hidden) {
        this.$emit('onhide')
      },
      property: function (prop) {
        sheet.cssRules[this.idx].style[this.props[this.line.type]] = this.line.prop
      },
      fontfamily: function (font) {
        sheet.cssRules[this.idx].style.fontFamily = font
        if (typeof (colorConfigData.settings.google_fonts) == 'undefined') {
          colorConfigData.settings.google_fonts = {}
        }
        colorConfigData.settings.google_fonts[this.line.class] = font
      },
      fontsize: function (size) {
        sheet.cssRules[this.idx].style.fontSize = size
      }
    },
    components: {
    },
    methods: {
      onKeyDownFontSize: function (event) {
        if ([38, 40].indexOf(event.keyCode) == -1) return
        var val = parseFloat(this.line.fontsize)
        var unit = this.line.fontsize.replace(val, '')
        var i = 1
        if (event.ctrlKey) i = i * 100
        if (event.shiftKey) i = i * 10
        if (event.altKey) i = i / 10
        switch (event.keyCode) {
          case 38: //up
            val += i
            break
          case 40: //down
            val -= i
            break
        }
        if (val < 0) val = 0
        val = Math.round(val * 10) / 10
        this.line.fontsize = val + unit
        this.$forceUpdate()
      },
      onInputFontSize: function (event) {
        var val = event.target.value
        this.line.fontsize = val
      },
      changeWidth: function (width) {
        if (this.line.width == 'container') {
          var winWidth = window.innerWidth
          var width = 750
          if (winWidth > 991) {
            width = 970
          }
          if (winWidth > 1199) {
            width = 1170
          }
          sheet.cssRules[this.idx].style.width = width + 'px'
        } else {
          sheet.cssRules[this.idx].style.width = '100%'
        }
      },
      changeFont: function (font) {
        WebFont.load({
          google: {
            families: [font]
          }
        })
        this.line.fontfamily = font
      }
    },
    mounted: function () {
      var selector = this.line.class.replace(/::hover/g, '')
      selector = selector.replace(/::active/g, '')
      selector = selector.replace(/::focus/g, '')
      selector = selector.replace(/::before/g, '')
      selector = selector.replace(/::after/g, '')

      selector = selector.replace(/:hover/g, '')
      selector = selector.replace(/:active/g, '')
      selector = selector.replace(/:focus/g, '')
      selector = selector.replace(/:before/g, '')
      selector = selector.replace(/:after/g, '')
      
      if ($(selector).length == 0) {
        this.hidden = true
      }
      sheet.insertRule(this.line.class + '{ }', sheet.cssRules.length)
      this.idx = sheet.cssRules.length - 1
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
    el: '#colorconfigurator',
    delimiters: ['##', '##'],
    data: function () {
      return {
        settings: colorConfigData.settings,
        colors: colorConfigData.colors,
        onsave: false,
        open: false,
        showColorPicker: false,
        activeLine: null,
        colorForCopy: 'black'
      }
    },
    computed: {
      color: function () {
        return (this.activeLine !== null) ? this.activeLine.color : 'black'
      }
    },
    components: {
      colorpicker: VueColor.Chrome
    },
    methods: {
      changeActiveLine: function (line) {
        this.showColorPicker = true
        this.activeLine = line
      },
      copyColor: function () {
        this.colorForCopy = this.activeLine.color
      },
      pastColor: function () {
        var c = tinycolor(this.colorForCopy)
        if (c.isValid) {
          this.onUpdateColor({rgba: this.colorForCopy})
        }
      },
      resetColor: function () {
        this.onUpdateColor(null);
      },
      closeColorpicker: function () {
        this.showColorPicker = false;
      },
      onUpdateColor: function (color) {
        console.log(this.activeLine);
        console.log(sheet);
        if (this.activeLine === null) {
          return
        }

        var c = null,
            s = '';

        if (color !== null) {
          c = tinycolor(color.rgba);
          s = c.toString();
        }

        this.activeLine.color = s
        if (this.activeLine.type == 'box') {
          var shadow = this.activeLine.prop
          shadow = (shadow !== '') ? shadow : $(this.activeLine.class).css('box-shadow')
          if (shadow != 'none' && shadow != 'undefined') {
            var parts = shadow.split(/ (?![^\(]*\))/)
            var oldColor = parts.filter(function(part) {
              var c = tinycolor(part)
              return c.isValid()
            })[0]
            s = shadow.replace(oldColor, s)
          }
        }
        this.activeLine.prop = s
        //sheet.cssRules[this.idx].style[this.props[this.line.type]] = s

        if (this.activeLine.type == 'textshadow') {
          var idx = undefined;
          var className = this.activeLine.class.replace(/\s/g, '');
          className = className.replace(/:/g, '')
          for (var i = 0; i < sheet.cssRules.length; i++) {
            var classNameTmp = sheet.cssRules[i].selectorText.replace(/\s/g, '');
            classNameTmp = classNameTmp.replace(/:/g, '')
            if (classNameTmp == className) {
              idx = i;
              break;
            }
          }
          if (idx !== undefined) {
            sheet.cssRules[idx].style['textShadow'] = s+' '+this.activeLine.h_shadow+' '+this.activeLine.v_shadow+' '+this.activeLine.blur_radius;
          }
        }

        this.$forceUpdate()
      },
      changeWidth: function (width) {
        this.settings.width = width
        var className = this.settings.container_class
        if (width == 'wide') {
          $(className).css('max-width', '100%')
        } else {
          $(className).css({
            'max-width': '1200px',
            'margin': 'auto'
          })
        }
      },
      changeFixed: function (fixed) {
        var stickyStr = '{position: -webkit-sticky; position: -moz-sticky; position: -ms-sticky; position: -o-sticky; position: sticky;}'
        this.settings.fixedmenu = fixed
        if (this.settings.menu_class == '') {
          return
        }
        var className = this.settings.menu_class
        if (fixed) {
          var res = getStyle(className, 'position', 'relative')
          if (typeof(res) !== 'undefined') {
            res.sheet.deleteRule(res.idx)
          }
          sheet.insertRule(className + stickyStr, sheet.cssRules.length)
        } else {
          var res = getStyle(className, 'position', 'sticky')
          if (typeof(res) !== 'undefined') {
            res.sheet.deleteRule(res.idx)
          }
          sheet.insertRule(className + '{position: relative}', sheet.cssRules.length)
        }
        addStyleFixedMenu();
      },
      changeRadius: function (radius) {
        if (this.settings.radius_classes == '') {
          return
        }
        this.settings.borderradius = radius
        var classes = this.settings.radius_classes
        if (!radius) {
          var res = getStyle(classes, 'borderRadius', '0px')
          if (typeof(res) !== 'undefined') {
            res.sheet.deleteRule(res.idx)
          }
          sheet.insertRule(classes + '{border-radius: 0;}', sheet.cssRules.length)
        } else {
          var res = getStyle(classes, 'borderRadius', '0px')
          if (typeof(res) !== 'undefined') {
            res.sheet.deleteRule(res.idx)
          }
        }
      },
      changeShadow: function (shadow) {
        if (this.settings.shadow_classes == '') {
          return
        }
        this.settings.boxshadow = shadow
        var classes = this.settings.shadow_classes
        if (!shadow) {
          var res = getStyle(classes, 'boxShadow', 'none')
          if (typeof(res) !== 'undefined') {
            res.sheet.deleteRule(res.idx)
          }
          sheet.insertRule(classes + '{box-shadow: none;}', sheet.cssRules.length)
        } else {
          var res = getStyle(classes, 'boxShadow', 'none')
          if (typeof(res) !== 'undefined') {
            res.sheet.deleteRule(res.idx)
          }
        }
      },
      changeTextShadow: function (colors){
        for (var i = 0; i < sheet.cssRules.length; i++) {
          sheet.cssRules[i].style['textShadow'] = '';
        }
      },
      save: function (res) {
        var self = this
        this.onsave = true
        var data = {
          colors: this.colors,
          settings: this.settings
        }
        $.post(colorSave, {data: data}, function (res) {
          res = JSON.parse(res)
          if (res.success === true) {
            self.onsave = false
          } else {
          }
        }).fail(function (err) {
          console.log(err)
        })
      },
      reset: function () {
        this.settings = JSON.parse(JSON.stringify(backColorConfigData.settings))
        this.colors = JSON.parse(JSON.stringify(backColorConfigData.colors))
        this.changeShadow(this.settings.boxshadow)
        this.changeRadius(this.settings.borderradius)
        this.changeFixed(this.settings.fixedmenu)
        this.changeWidth(this.settings.width)
        this.changeTextShadow(this.colors)


        this.$forceUpdate()
      },
      searchBySelector: function (e) {
        this.$refs.group.map(function(group) {
          group.searchInGroup(e.target.value)
        })
      },
      showAllToggle: function (show) {
        this.$refs.group.map(function(group) {
          group.showAllToggle(show)
        })
      },
    },
    mounted: function () {
      var self = this;
      $(document).click(function (event) {
        if (!$(event.target).hasClass('color') && $(event.target).closest(self.$refs.colorpicker).length == 0) {
          self.showColorPicker = false
        }
      })
    }
  })
  // deleteCSSRuleDuplicate();

  $(window).scroll(function() {
      if (!colorConfigData.settings.fixedmenu || (colorConfigData.settings.fixedmenu && !colorConfigData.settings.fixed_menu)
          || !colorConfigData.settings.menu_class || !colorConfigData.settings.fixed_menu_classes) {
        return 0;
      }

      var menu_classes_list = colorConfigData.settings.menu_class.split(',');
      var fix_menu_classes_list = colorConfigData.settings.fixed_menu_classes.split(',');

      if($(window).width() > 768){
              var scrollY=$(window).scrollTop();
              if (scrollY > 50) {
                  for (var i = 0; i < menu_classes_list.length; i++) {
                    for (var j = 0; j < fix_menu_classes_list.length; j++) {
                      $(menu_classes_list[i]).addClass(fix_menu_classes_list[j]);
                    }
                  }
              } else {
                  for (var i = 0; i < menu_classes_list.length; i++) {
                    for (var j = 0; j < fix_menu_classes_list.length; j++) {
                      $(menu_classes_list[i]).removeClass(fix_menu_classes_list[j]);
                    }
                  }
              }
      } else {
          for (var i = 0; i < menu_classes_list.length; i++) {
            for (var j = 0; j < fix_menu_classes_list.length; j++) {
              $(menu_classes_list[i]).removeClass(fix_menu_classes_list[j]);
            }
          }
      }
  }).trigger('scroll');

  app.changeShadow(colorConfigData.settings.boxshadow);

  addStyleFixedMenu();

})

function addStyleFixedMenu() {
  var menu_classes_list = colorConfigData.settings.menu_class.split(',');
  if (parseInt(colorConfigData.settings.fixedmenu)) {
    if (colorConfigData.settings.fix_menu_top != "" && colorConfigData.settings.fix_menu_top != undefined) {
      for (var i = 0; i < menu_classes_list.length; i++) {
          $(menu_classes_list[i]).css("top", colorConfigData.settings.fix_menu_top);
      }
    }
    if (colorConfigData.settings.fix_menu_zindex != "" && colorConfigData.settings.fix_menu_zindex != undefined) {
      for (var i = 0; i < menu_classes_list.length; i++) {
          $(menu_classes_list[i]).css("z-index", colorConfigData.settings.fix_menu_zindex);
      }
    }
  } else {
    for (var i = 0; i < menu_classes_list.length; i++) {
        $(menu_classes_list[i]).css("top", "");
        $(menu_classes_list[i]).css("z-index", "");
    }
  }
}

// function deleteCSSRuleDuplicate() {
//   var styleSheetList = document.styleSheets;
//   var cssStyleRule;
//   var currentSearch;
//   for (var i = styleSheetList.length - 1; i >= 0; i--) {
//     if (styleSheetList[i]['href'] != null) {
//       continue;
//     }
//     try {
//       cssStyleRule = styleSheetList[i]['cssRules'];
//     } catch (err) {
//       continue;
//     }
//     for (var j = cssStyleRule.length - 1; j >= 0; j--) {
//       currentSearch = cssStyleRule[j]['cssText'];
//       for (var k = j; k >= 0; k--) {
//         try {
//           if (j != k && currentSearch == cssStyleRule[k]['cssText']) {
//             window.document.styleSheets[i].removeRule(k);
//           }
//         } catch (err) {
//           continue;
//         }
//       }
//     }
//   }
// }

var app = null

var is_click = false;
var last_option = "wide";
$("body").on("click", ".width-buttons .btn-default.active", function(){
  if (!is_click && $(this).children("input").attr("id") != last_option) {
    $('.rev_slider_wrapper').css("overflow", "");
    $('.rev_slider_wrapper').css("left", "");
    $('.rev_slider_wrapper').toggleClass("slider-box-custom");
    $(".tp-rightarrow").trigger('click');
    is_click = true;
    last_option = $(this).children("input").attr("id");
  }

	setTimeout(function() { is_click = false; }, 500);
});
