var slidebars = function () {

  /**
   * Setup
   */

  // Cache all canvas elements
  var canvas = $('body');
  // Object of Slidebars
  var sideBars = {};
  // Variables, permitted sides and styles
  var init = false;
  var registered = false;
  var sides = ['top', 'right', 'bottom', 'left'];
  var styles = ['reveal', 'push', 'overlay', 'shift'];
  /**
   * Get Animation Properties
   */

  var getAnimationProperties = function (id) {
    // Variables
    var elements = $();
    var amount = '0px, 0px';
    var duration = parseFloat(sideBars[ id ].element.css('transition-Duration'), 10) * 1000;

    // Elements to animate
    if (sideBars[ id ].style === 'reveal' || sideBars[ id ].style === 'push' || sideBars[ id ].style === 'shift') {
      elements = elements.add(canvas);
    }

    if (sideBars[ id ].style === 'push' || sideBars[ id ].style === 'overlay' || sideBars[ id ].style === 'shift') {
      elements = elements.add(sideBars[ id ].element);
    }

    // Amount to animate
    if (sideBars[ id ].active) {
      if (sideBars[ id ].side === 'top') {
        amount = '0px, ' + sideBars[ id ].element.css('height');
      } else if (sideBars[ id ].side === 'right') {
        amount = '-' + sideBars[ id ].element.css('width') + ', 0px';
      } else if (sideBars[ id ].side === 'bottom') {
        amount = '0px, -' + sideBars[ id ].element.css('height');
      } else if (sideBars[ id ].side === 'left') {
        amount = sideBars[ id ].element.css('width') + ', 0px';
      }
    }

    // Return animation properties
    return {'elements': elements, 'amount': amount, 'duration': duration};
  };
  /**
   * Slidebars Registration
   */

  var registerSlidebar = function (id, active, side, style, element) {
    // Check if Slidebar is registered
    if (isRegisteredSlidebar(id)) {
      throw "Error registering Slidebar, a Slidebar with id '" + id + "' already exists.";
    }
    $('#' + id).addClass('sidebar-' + side);
    // Register the Slidebar
    sideBars[ id ] = {
      'id': id,
      'side': side,
      'style': style,
      'element': element,
      'active': active
    };
  };
  var isRegisteredSlidebar = function (id) {
    // Return if Slidebar is registered
    if (sideBars.hasOwnProperty(id)) {
      return true;
    } else {
      return false;
    }
  };

  /**
   * Initialization
   */

  this.init = function (callback) {
    // Check if Slidebars has been initialized
    if (init) {
      throw "Slidebars has already been initialized.";
    }

    // Loop through and register Slidebars
    if (!registered) {
      $('.sidebar').each(function () {
        // Register Slidebar
        registerSlidebar($(this).data('id'), $(this).data('active'), $(this).data('side'), $(this).data('style'), $(this));
      });
      // Set registered variable
      registered = true;
    }

    // Set initialized variable
    init = true;

    // Set CSS
    this.css();

    // Trigger event
    $(events).trigger('init');

    // Run callback
    if (typeof callback === 'function') {
      callback();
    }
  };

  this.exit = function (callback) {
    // Check if Slidebars has been initialized
    if (!init) {
      throw "Slidebars hasn't been initialized.";
    }

    // Exit
    var exit = function () {
      // Set init variable
      init = false;

      // Trigger event
      $(events).trigger('exit');

      // Run callback
      if (typeof callback === 'function') {
        callback();
      }
    };

    // Call exit, close open Slidebar if active
    if (this.getActiveSlidebar()) {
      this.close(exit);
    } else {
      exit();
    }
  };

  /**
   * CSS
   */

  this.css = function (callback) {
    // Check if Slidebars has been initialized
    if (!init) {
      throw "Slidebars hasn't been initialized.";
    }

    // Loop through Slidebars to set negative margins
    for (var id in sideBars) {
      // Check if Slidebar is registered
      if (isRegisteredSlidebar(id)) {
        // Calculate offset
        var offset;

        if (sideBars[ id ].side === 'top' || sideBars[ id ].side === 'bottom') {
          offset = sideBars[ id ].element.css('height');
        } else {
          offset = sideBars[ id ].element.css('width');
        }

        // Apply negative margins
        if (sideBars[ id ].style === 'push' || sideBars[ id ].style === 'overlay' || sideBars[ id ].style === 'shift') {
          sideBars[ id ].element.css('margin-' + sideBars[ id ].side, '-' + offset);
        }
      }
    }

    // Reposition open Slidebars
    if (this.getActiveSlidebar()) {
      this.open(this.getActiveSlidebar());
    }

    // Trigger event
    $(events).trigger('css');

    // Run callback
    if (typeof callback === 'function') {
      callback();
    }
  };

  /**
   * Controls
   */
  this.open = function (id, callback) {
    // Check if Slidebars has been initialized
    if (!init) {
      throw "Slidebars hasn't been initialized.";
    }

    // Check if id wasn't passed
    if (!id) {
      throw "You must pass a Slidebar id.";
    }

    // Check if Slidebar is registered
    if (!isRegisteredSlidebar(id)) {
      throw "Error opening Slidebar, there is no Slidebar with id '" + id + "'.";
    }

    // Open
    var open = function () {
      // Set active state to true
      sideBars[ id ].active = true;

      // Display the Slidebar
      sideBars[ id ].element.css('display', 'block');
      sideBars[ id ].element.addClass('slidebar-opened');

      // Trigger event
      $(events).trigger('opening', [sideBars[ id ].id]);

      // Get animation properties
      var animationProperties = getAnimationProperties(id);

      // Apply css
      animationProperties.elements.css({
        'transition-duration': animationProperties.duration + 'ms',
        'transform': 'translate(' + animationProperties.amount + ')'
      });

      // Transition completed
      setTimeout(function () {
        // Trigger event
        $(events).trigger('opened', [sideBars[ id ].id]);

        // Run callback
        if (typeof callback === 'function') {
          callback();
        }
      }, animationProperties.duration);
    };

    // Call open, close open Slidebar if active
    if (this.getActiveSlidebar() && this.getActiveSlidebar() !== id) {
      this.close(open);
    } else {
      open();
    }
  };

  this.close = function (id, callback) {
    // Shift callback arguments
    if (typeof id === 'function') {
      callback = id;
      id = null;
    }

    // Check if Slidebars has been initialized
    if (!init) {
      throw "Slidebars hasn't been initialized.";
    }

    // Check if id was passed but isn't a registered Slidebar
    if (id && !isRegisteredSlidebar(id)) {
      throw "Error closing Slidebar, there is no Slidebar with id '" + id + "'.";
    }

    // If no id was passed, get the active Slidebar
    if (!id) {
      id = this.getActiveSlidebar();
    }

    // Close a Slidebar
    if (id && sideBars[ id ].active) {
      // Set active state to false
      sideBars[ id ].active = false;

      // Trigger event
      $(events).trigger('closing', [sideBars[ id ].id]);

      // Get animation properties
      var animationProperties = getAnimationProperties(id);

      // Apply css
      animationProperties.elements.css('transform', '');
      animationProperties.element.removeClass('slidebar-opened');

      // Transition completetion
      setTimeout(function () {
        // Remove transition duration
        animationProperties.elements.css('transition-duration', '');

        // Hide the Slidebar
        sideBars[ id ].element.css('display', '');

        // Trigger event
        $(events).trigger('closed', [sideBars[ id ].id]);

        // Run callback
        if (typeof callback === 'function') {
          callback();
        }
      }, animationProperties.duration);
    }
  };

  this.toggle = function (id, callback) {
    // Check if Slidebars has been initialized
    if (!init) {
      throw "Slidebars hasn't been initialized.";
    }

    // Check if id wasn't passed
    if (!id) {
      throw "You must pass a Slidebar id.";
    }

    // Check if Slidebar is registered
    if (!isRegisteredSlidebar(id)) {
      throw "Error toggling Slidebar, there is no Slidebar with id '" + id + "'.";
    }

    // Check Slidebar state
    if (sideBars[ id ].active) {
      // It's open, close it
      this.close(id, function () {
        // Run callback
        if (typeof callback === 'function') {
          callback();
        }
      });
    } else {
      // It's closed, open it
      this.open(id, function () {
        // Run callback
        if (typeof callback === 'function') {
          callback();
        }
      });
    }
  };

  /**
   * Active States
   */

  this.isActive = function () {
    // Return init state
    return init;
  };

  this.isActiveSlidebar = function (id) {
    // Check if Slidebars has been initialized
    if (!init) {
      throw "Slidebars hasn't been initialized.";
    }

    // Check if id wasn't passed
    if (!id) {
      throw "You must provide a Slidebar id.";
    }

    // Check if Slidebar is registered
    if (!isRegisteredSlidebar(id)) {
      throw "Error retrieving Slidebar, there is no Slidebar with id '" + id + "'.";
    }

    // Return the active state
    return sideBars[ id ].active;
  };

  this.getActiveSlidebar = function () {
    // Check if Slidebars has been initialized
    if (!init) {
      throw "Slidebars hasn't been initialized.";
    }

    // Variable to return
    var active = false;

    // Loop through Slidebars
    for (var id in sideBars) {
      // Check if Slidebar is registered
      if (isRegisteredSlidebar(id)) {
        // Check if it's active
        if (sideBars[ id ].active) {
          // Set the active id
          active = sideBars[ id ].id;
          break;
        }
      }
    }

    // Return
    return active;
  };

  this.getSlidebars = function () {
    // Check if Slidebars has been initialized
    if (!init) {
      throw "Slidebars hasn't been initialized.";
    }

    // Create an array for the Slidebars
    var slidebarsArray = [];

    // Loop through Slidebars
    for (var id in sideBars) {
      // Check if Slidebar is registered
      if (isRegisteredSlidebar(id)) {
        // Add Slidebar id to array
        slidebarsArray.push(sideBars[ id ].id);
      }
    }

    // Return
    return slidebarsArray;
  };

  this.getSlidebar = function (id) {
    // Check if Slidebars has been initialized
    if (!init) {
      throw "Slidebars hasn't been initialized.";
    }

    // Check if id wasn't passed
    if (!id) {
      throw "You must pass a Slidebar id.";
    }

    // Check if Slidebar is registered
    if (!isRegisteredSlidebar(id)) {
      throw "Error retrieving Slidebar, there is no Slidebar with id '" + id + "'.";
    }

    // Return the Slidebar's properties
    return sideBars[ id ];
  };

  /**
   * Events
   */
  this.events = {};
  var events = this.events;

  /**
   * Resizes
   */
  $(window).on('resize', this.css.bind(this));
};