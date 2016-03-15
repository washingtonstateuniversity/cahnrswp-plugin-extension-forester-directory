// JavaScript Document
var CAHNRSWP_Dir = {
	
	wrap: jQuery('#cwpdir'),
	
	init:function(){
		
		CAHNRSWP_Dir.lightbox.init();
		
		CAHNRSWP_Dir.search_box.init();
		
		CAHNRSWP_Dir.filters.init();
	},
	
	search_box: {
		
		init: function(){
			
			CAHNRSWP_Dir.wrap.on('keyup', '#cwpdir-search input' , function(){ CAHNRSWP_Dir.search_box.do_search( jQuery( this ) ); });
			
		},
		
		do_search: function( sear ){
			
			jQuery('.directory-card').each( function(){
				
				var val = sear.val().toLowerCase();
			
				var text = jQuery( this ).text().toLowerCase();
				
				if ( text.search( val ) > -1 ) {
					
					jQuery( this ).show();
					
				} else {
					
					jQuery( this ).hide();
					
				} // end if
			
			});
			
			var val = sear.val();
			
		}
		
	},
	
	filters:{
		
		init: function(){
			
			CAHNRSWP_Dir.wrap.on('change' , '#cwpdir-filter select' , function(){ CAHNRSWP_Dir.filters.do_filters(); });
			
		},
		
		do_filter: function( val , wrap_class ){
			
			jQuery('.directory-card').each( function(){
				
				var txt = jQuery( this ).find( '.' + wrap_class ).text();
				
				if ( txt.search( val ) > -1 ) {
					
					//jQuery( this ).show();
					
				} else {
					
					jQuery( this ).hide();
					
				}
			
			});
			
		},
		
		do_filters: function(){
			
			var county_val = CAHNRSWP_Dir.wrap.find('select[name="county"]').val();
			
			var service_val = CAHNRSWP_Dir.wrap.find('select[name="service"]').val();
			
			var type_val = CAHNRSWP_Dir.wrap.find('select[name="type"]').val();
			
			jQuery('.directory-card').each( function(){
				
				jQuery( this ).show();
				
				if ( county_val != 'none' && jQuery( this ).find('.directory-profile-locations').text().search( county_val ) == -1 ){
					
					jQuery( this ).hide();
					
				} else if ( service_val != 'none' && jQuery( this ).find('.directory-profile-services').text().search( service_val ) == -1 ){
					
					jQuery( this ).hide();
					
				} else if ( type_val != 'none' && jQuery( this ).find('.directory-profile-type').text().search( type_val ) == -1 ){
					
					jQuery( this ).hide();
					
				} // end if
				
			
			});
			
		}
		
	},
	
	lightbox: {
		
		bg: false,
		
		frame: false,
		
		init:function(){
			
			CAHNRSWP_Dir.lightbox.add_lb();
			
			jQuery('body').on( 'click' , '.directory-profile-button a' , function( event ){ event.preventDefault(); CAHNRSWP_Dir.lightbox.show( jQuery( this ) ); });
			
			jQuery('body').on( 'click' , '.cwpdir-close' , function( event ){ event.preventDefault(); CAHNRSWP_Dir.lightbox.hide(); });
			
		},
		
		add_lb:function(){
			
			var lb = '<div id="cwpdir-lb-bg" class="cwpdir-close"></div><div id="cwpdir-lb"><section><a href="#" class="cwpdir-close">x</a><div class="cwpdir-content"></div></section></div>';
			
			jQuery('body').append( lb );
			
			CAHNRSWP_Dir.lightbox.bg = jQuery('#cwpdir-lb-bg');
			
			CAHNRSWP_Dir.lightbox.frame = jQuery('#cwpdir-lb');
			
		},
		
		show:function( ic ){
			
			var id = ic.data('id');
			
			var content = jQuery('#' + id ).html();
			
			jQuery( '#cwpdir-lb .cwpdir-content').html( content );
			
			CAHNRSWP_Dir.lightbox.bg.fadeIn('fast' , function(){ CAHNRSWP_Dir.lightbox.frame.show(); })
			
		},
		
		hide:function(){
			
			CAHNRSWP_Dir.lightbox.frame.hide();
			
			CAHNRSWP_Dir.lightbox.frame.find('.cwpdir-content').html();
			
			CAHNRSWP_Dir.lightbox.bg.fadeOut('fast');
			
		}
		
	}
	
}

CAHNRSWP_Dir.init();