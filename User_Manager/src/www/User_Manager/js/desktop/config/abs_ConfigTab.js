Ext.define('darkowl.desktop.config.abs_ConfigTab',
	{
		extend: 'Ext.form.Panel',
		category: "Default",
		loadConfig: function()
		{
			console.log("load config - " +
				this.category);
			this.load({
				headers: {
					Accept: "application/json"
				},
				url: "../rest/config/" +
					this.category,
				method: "get",
				success: function(obj_Form) {
//					this.hideMask();
				},
				failure: function() {
//					this.hideMask();
				},
				scope: this
			});
		}
	});


