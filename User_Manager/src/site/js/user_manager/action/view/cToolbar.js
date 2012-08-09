Ext
        .define(
                'darkowl.userManager.action.view.cToolbar',
                {
                    extend : 'Ext.toolbar.Toolbar',
                    requires :
                    [ 'Ext.button.Button',
                            'darkowl.userManager.eventManager.cStartMenuEvents' ],
                    initComponent : function()
                    {
	                    this.callParent();

	                    if (g_obj_Config.m_bool_Action_Add)
	                    {
		                    this
		                            .add(new Ext.button.Button(
		                                    {
		                                        text : "Add",
		                                        iconCls : 'toolbar-action-add-icon',
		                                        tooltip : "Add Action",
		                                        handler : function()
		                                        {
			                                        startMenu.MsgBus
			                                                .fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_ACTION_ADD);
		                                        }
		                                    }));
	                    }

	                    if (g_obj_Config.m_bool_Action_Edit)
	                    {
		                    this
		                            .add(new Ext.button.Button(
		                                    {
		                                        text : "Edit",
		                                        iconCls : 'toolbar-action-edit-icon',
		                                        tooltip : "Edit Action",
		                                        handler : function()
		                                        {
			                                        startMenu.MsgBus
			                                                .fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_ACTION_EDIT);
		                                        }
		                                    }));
	                    }

	                    if (g_obj_Config.m_bool_Action_Delete)
	                    {
		                    this
		                            .add(new Ext.button.Button(
		                                    {
		                                        text : "Delete",
		                                        iconCls : 'toolbar-action-delete-icon',
		                                        tooltip : "Delete Action",
		                                        handler : function()
		                                        {
			                                        startMenu.MsgBus
			                                                .fireEvent(startMenu.MsgBus.self.C_STR_EVENT_OPEN_USER_ADD);
		                                        }
		                                    }));
	                    }
                    }
                });