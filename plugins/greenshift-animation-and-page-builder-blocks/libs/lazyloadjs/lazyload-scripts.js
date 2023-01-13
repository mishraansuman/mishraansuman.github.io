class GsLazyLoadScripts {

	constructor( triggerEvents ) {
		this.attrName = 'data-gslazyloadscript';
		this.triggerEvents = triggerEvents;
		this.userEventListener = this.triggerListener.bind( this );
		this.autoLoadTimer = null;
	}

	/**
	 * Initializes the LazyLoad Scripts handler.
	 */
	init() {
		this._addEventListener( this );
		this._autoload();
	}

	/**
	 * Resets the handler.
	 */
	reset() {
		this._removeEventListener( this );
		if ( null === this.autoLoadTimer ) {
			return;
		}
		clearTimeout( this.autoLoadTimer );
		this.autoLoadTimer = null;
	}

	/**
	 * Adds a listener for each of the configured user interactivity event type. When an even is triggered, it invokes
	 * the triggerListener() method.
	 *
	 * @private
	 *
	 * @param self Instance of this object.
	 */
	_addEventListener( self ) {
		this.triggerEvents.forEach(
			eventName => window.addEventListener( eventName, self.userEventListener, { passive: true } )
		);
	}

	/**
	 * Removes the listener for each of the configured user interactivity event type.
	 *
	 * @private
	 *
	 * @param self Instance of this object.
	 */
	_removeEventListener( self ) {
		this.triggerEvents.forEach(
			eventName => window.removeEventListener( eventName, self.userEventListener, { passive: true })
		);
	}

	/**
	 * Loads the script's src from the data attribute, which will then trigger the browser to request and
	 * load the script.
	 */
	_loadScriptSrc() { 
		const scripts = document.querySelectorAll( `script[${ this.attrName }]` );

		if ( 0 === scripts.length ) {
			this.reset();
			return;
		}

		Array.prototype.slice.call( scripts ).forEach( elem => {
			 const scriptSrc = elem.getAttribute( this.attrName );
			elem.async = false;
			elem.removeAttribute( this.attrName );
			elem.setAttribute( 'src', scriptSrc );
		} );

		this.reset();
	}

	/**
     * Triggered  autoload if no user interaction up to 5 secodns.
     */
	_autoload() {
		this.autoLoadTimer = setTimeout( this.triggerListener.bind( this ), 5000);
	}

	/**
	 * Window event listener - when triggered, invokes the load script src handler and then resets.
	 */
	triggerListener() {
		this._loadScriptSrc();
		this._removeEventListener( this );
	}

	/**
	 * Named static constructor to encapsulate how to create the object.
	 */
	static run() {

		const instance = new GsLazyLoadScripts(
			[
				'keydown',
				'mouseover',
				'touchmove',
				'touchstart',
				'wheel',
				'touchend'
			],
		);
		instance.init();
	}
}

GsLazyLoadScripts.run();


