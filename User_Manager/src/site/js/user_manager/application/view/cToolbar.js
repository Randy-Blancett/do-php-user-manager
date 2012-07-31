Ext
        .define(
                'darkowl.userManager.application.view.cToolbar',
                {
                    extend : 'Ext.toolbar.Toolbar',
                    requires :
                    [ 'Ext.button.Button',
                            'darkowl.userManager.eventManager.cStartMenuEvents' ],
                    initComponent : function()
                    {
	                    this.callParent();

	                    if (g_obj_Config.m_bool_App_Add)
	                    {
		                    this
		                            .add(new Ext.button.Button(
		                                    {
		                                        text : "Add",
		                                        iconCls : 'toolbar-app-add-icon',
		                                        tooltip : "Add Application",
		                                        handler : function()
		                                        {
			                                        startMenu.MsgBus
			                                                .fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_APP_ADD);
		                                        }
		                                    }));
	                    }

	                    if (g_obj_Config.m_bool_App_Edit)
	                    {
		                    this
		                            .add(new Ext.button.Button(
		                                    {
		                                        text : "Edit",
		                                        iconCls : 'toolbar-app-edit-icon',
		                                        tooltip : "Edit Application",
		                                        handler : function()
		                                        {
			                                        startMenu.MsgBus
			                                                .fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_USER_ADD);
		                                        }
		                                    }));
	                    }

	                    if (g_obj_Config.m_bool_App_Delete)
	                    {
		                    this
		                            .add(new Ext.button.Button(
		                                    {
		                                        text : "Delete",
		                                        iconCls : 'toolbar-app-delete-icon',
		                                        tooltip : "Delete Application",
		                                        handler : function()
		                                        {
			                                        startMenu.MsgBus
			                                                .fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_USER_ADD);
		                                        }
		                                    }));
	                    }
                    }
                });