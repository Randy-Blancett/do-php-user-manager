Ext
        .define(
                'darkowl.userManager.action.view.cGrid',
                {
                    extend : 'Ext.grid.Panel',
                    requires :
                    [ // 'plugin.grid.cSearch',
                    'Ext.toolbar.Paging',
                            'darkowl.userManager.store.cActionList' ],
                    columns :
                    [
                    {
                        header : 'ID',
                        dataIndex : 'id',
                        flex : 1
                    },
                    {
                        header : 'Name',
                        dataIndex : 'name',
                        flex : 1
                    },
                    {
                        header : 'Application',
                        dataIndex : 'applicationName',
                        flex : 1
                    } ],
                    initComponent : function()
                    {
	                    this.store = Ext
	                            .create('darkowl.userManager.store.cActionList');

	                    this.m_obj_Pageing = Ext.create("Ext.toolbar.Paging",
	                    {
	                        store : this.store,
	                        dock : 'bottom',
	                        displayInfo : true
	                    });

	                    this.callParent();

	                    this.on("beforeload", function()
	                    {
		                    this.body.mask('Loading', 'x-mask-loading');
	                    }, this);

	                    this.on("load", function()
	                    {
		                    this.body.unmask();
	                    }, this);

	                    this.addDocked(this.m_obj_Pageing);
	                    if (g_obj_Config.m_bool_Action_Edit)
	                    {
		                    this.on("itemdblclick", this.doItemDblClick);
	                    }
                    },
                    doItemDblClick : function(obj_View, obj_Record, obj_Html,
                            int_Index, obj_Event, obj_Options)
                    {
	                    this.ownerCt
	                            .fireEvent(darkowl.userManager.action.view.cWindow.C_STR_EVENT_EDIT);
                    }

                });