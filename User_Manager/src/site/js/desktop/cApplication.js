Ext.define('darkowl.desktop.cApplication', 
{
    mixins: 
    {
        observable: 'Ext.util.Observable'
    },

    requires:
    [
     'darkowl.desktop.cDesktop',
//	     'DarkOwl.User_Manager.EventHandler.cSystemEvents',
//	     'DarkOwl.User_Manager.EventHandler.cWindowEvents',
//	     
//	     'Ext.container.Viewport',
	     'Ext.util.MixedCollection'
    ],
    m_obj_Windows :null,
    m_obj_SystemEvents:null,
    m_obj_WindowEvents:null,
    m_obj_Desktop:null,
    m_obj_ViewPort:null,

    isReady: false,

    constructor: function (config) 
    {
        var obj_This = this;
        
        this.m_obj_Windows = Ext.create("Ext.util.MixedCollection");
        
        //add Events to object
        this.addEvents
        (
            'ready',
            'beforeunload'
        );
        
//        this.m_obj_SystemEvents = Ext.create("DarkOwl.User_Manager.EventHandler.cSystemEvents",
//        {
//        	m_obj_MsgBus: obj_This,
//        });
//        
//        this.m_obj_WindowEvents = Ext.create("DarkOwl.User_Manager.EventHandler.cWindowEvents",
//        {
//        	m_obj_Windows	: obj_This.m_obj_Windows,
//        	m_obj_MsgBus	: obj_This,
//        	m_obj_Desktop	: obj_This.m_obj_Desktop
//        });

       this.mixins.observable.constructor.call(this, config);

        if (Ext.isReady) 
        {
            Ext.Function.defer(obj_This.init, 10, obj_This);
        } 
        else 
        {
            Ext.onReady(obj_This.init, obj_This);
        }
    },

    init: function() 
    {
        var  obj_This = this;
        
        Ext.QuickTips.init();

        this.m_obj_Desktop = Ext.create("darkowl.desktop.cDesktop",
        {
        	m_obj_Windows	: this.m_obj_Windows,
        m_str_WallPaper		: "../img/Wallpaper/desktop.jpg"
        });

        obj_This.m_obj_ViewPort = Ext.create("Ext.container.Viewport",        		
        {
            layout: 'fit',
            items: [ this.m_obj_Desktop ]
        });

        Ext.EventManager.on(window, 'beforeunload',  obj_This.onUnload, obj_This);

        obj_This.isReady = true;
        obj_This.fireEvent('ready', obj_This);
    },

    onReady : function(fn, scope) 
    {
        if (this.isReady) 
        {
            fn.call(scope, this);
        } else
        {
            this.on({
                ready: fn,
                scope: scope,
                single: true
            });
        }
    },

    getDesktop : function() 
    {
        return this.m_obj_Desktop;
    },

    onUnload : function(e) {
        if (this.fireEvent('beforeunload', this) === false) {
            e.stopEvent();
        }
    }
});