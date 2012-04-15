Ext.define('darkowl.desktop.module.cExample',
{
	extend : 'darkowl.desktop.module.abs_Module',
	// singleton : true,
	m_str_Name : "Desktop Example",
	requires :
	[
		'Ext.data.Store'
	],
	constructor : function (config)
	{
		this.m_obj_Shortcuts = Ext.create('Ext.data.Store',
		{
			fields : darkowl.desktop.module.abs_Module.C_ARR_FIELDS,
			data :
			{
				'items' :
				[
					{
						'name' : 'Example Shortcut',
						"iconCls" : "menu-action-view-icon",
						onClick : function ()
						{
							alert("Test Alert Example");
						}
					}
				]
			},
			proxy :
			{
				type : 'memory',
				reader :
				{
					type : 'json',
					root : 'items'
				}
			}
		});
		
		this.m_obj_QuickStart = Ext.create('Ext.data.Store',
				{
					fields : darkowl.desktop.module.abs_Module.C_ARR_FIELDS,
					data :
					{
						'items' :
						[
							{
								'name' : 'Example Shortcut',
								"iconCls" : "menu-action-view-icon",
								onClick : function ()
								{
									alert("Quick Start Example");
								}
							}
						]
					},
					proxy :
					{
						type : 'memory',
						reader :
						{
							type : 'json',
							root : 'items'
						}
					}
				});
	}
});