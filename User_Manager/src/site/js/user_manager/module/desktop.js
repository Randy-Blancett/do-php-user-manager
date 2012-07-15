Ext
        .define(
                'darkowl.userManager.module.desktop',
                {
                    extend : 'darkowl.desktop.module.abs_Module',
                    // singleton : true,
                    m_str_Name : "User Manager Desktop",
                    requires :
                    [ 'Ext.data.Store',
                            'darkowl.desktop.eventManager.cDesktopEvents',
                            'darkowl.userManager.setup.window.cWindow',
                            'darkowl.userManager.eventManager.cStartMenuEvents' ],
                    constructor : function(config)
                    {
	                    this.buildGeneralMenu();
	                    this.buildSpecialMenu();
                    },
                    buildSpecialMenu : function()
                    {
	                    this.m_obj_SpecialStartMenu = new Ext.util.MixedCollection();

	                    this.m_obj_SpecialStartMenu
	                            .add(
	                                    'Create Tables',
	                                    {
	                                        iconCls : "menu-create-db-icon",
	                                        onClick : function()
	                                        {
		                                        desktop.MsgBus
		                                                .fireEvent(
		                                                        desktop.MsgBus.self.C_STR_EVENT_OPEN_WINDOW,
		                                                        {},
		                                                        'darkowl.userManager.setup.window.cWindow');
	                                        }
	                                    });
                    },

                    buildGeneralMenu : function()
                    {
	                    this.m_obj_GeneralStartMenu = new Ext.util.MixedCollection();

	                    // this.m_obj_GeneralStartMenu.add('Action',
	                    // {
	                    // iconCls : "menu-action-icon",
	                    // submenu : null
	                    // });

	                     this.m_obj_GeneralStartMenu.add('User',
	                    {
	                        iconCls : "menu-user-icon",
	                        submenu : this.buildUserMenu()
	                    });

                    },
                    buildUserMenu : function()
                    {
	                    var obj_Menu = new Ext.util.MixedCollection();

	                    obj_Menu
	                            .add(
	                                    'Add',
	                                    {
	                                        iconCls : "menu-user-add-icon",
	                                        onClick : function()
	                                        {
		                                        startMenu.MsgBus
		                                                .fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_USER_ADD);
	                                        }
	                                    });
	                    obj_Menu
	                            .add(
	                                    'View',
	                                    {
	                                        iconCls : "menu-user-view-icon",
	                                        onClick : function()
	                                        {
		                                        startMenu.MsgBus
		                                                .fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_USER_VIEW);
	                                        }
	                                    });
	                    return obj_Menu;
                    }
                });