jQuery('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
    var $this = jQuery(this),
        label = $this.prev('label');
  
        if (e.type === 'keyup') {
              if ($this.val() === '') {
            label.removeClass('active highlight');
          } else {
            label.addClass('active highlight');
          }
      } else if (e.type === 'blur') {
          if( $this.val() === '' ) {
              label.removeClass('active highlight'); 
              } else {
              label.removeClass('highlight');   
              }   
      } else if (e.type === 'focus') {
        
        if( $this.val() === '' ) {
              label.removeClass('highlight'); 
              } 
        else if( $this.val() !== '' ) {
              label.addClass('highlight');
              }
      }
  
  });
  
  jQuery('.tab a').on('click', function (e) {
    
    e.preventDefault();
    
    jQuery(this).parent().addClass('active');
    jQuery(this).parent().siblings().removeClass('active');
    
    target = jQuery(this).attr('href');
  
    jQuery('.tab-content > div').not(target).hide();
    
    jQuery(target).fadeIn(600);
    
  });