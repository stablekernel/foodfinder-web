/*

 * JSON datasource
 * https://999softs.com
 *
 * Copyright (c) 2013
 * Demo source released to public domain.
 */

var MessageDataSource = function(options) {
	this._formatter = options.formatter;
	this._columns = options.columns;
	this._url = options.url;
};

MessageDataSource.prototype = {

	/**
	 * Returns stored column metadata
	 */
	columns : function() {
		return this._columns;
	},

	/**
	 * Called when Datagrid needs data. Logic should check the options parameter
	 * to determine what data to return, then return data by calling the
	 * callback.
	 * 
	 * @param {object}
	 *            options Options selected in datagrid (ex:
	 *            {pageIndex:0,pageSize:5,search:'searchterm'})
	 * @param {function}
	 *            callback To be called with the requested data.
	 */
	data : function(options, callback) {

		var url = ARNY.siteUrl + this._url;
		var self = this;

		page_size = options.pageSize;
		page_index = options.pageIndex;

		if (page_size) {
			url += page_size + "/";
		} else
			url += 5 + "/";
		if (page_index) {
			url += page_index + "/";
		} else
			url += 0 + "/";
		if (options.search) {
			url += options.search + "/";
		}
		url+='name=suresh/';
		/*
		 * url += '&tags=' + options.search; url += '&per_page=' +
		 * options.pageSize; url += '&page=' + (options.pageIndex + 1);
		 */

		$.ajax(url, {
			// Set JSON options
			dataType : 'json',
			type : 'POST',
			cache: false

		}).done(
				function(response) {
					if (response.messages) {
						// Prepare data to return to Datagrid
						var data = response.messages;
						var count = parseInt(response.count);
						var startIndex = (parseInt(response.page))
								* parseInt(response.per_page);
						var endIndex = parseInt(startIndex)
								+ parseInt(response.per_page);
						var end = (endIndex > count) ? count : endIndex;
						var pages = Math.ceil(parseInt(response.count)
								/ parseInt(response.per_page));
						var page = parseInt(response.page) + 1;
						var start = startIndex + 1;

						// Allow client code to format the data
						if (self._formatter)
							self._formatter(data);

						// Return data to Datagrid

						callback({
							data : data,
							start : start,
							end : end,
							count : count,
							pages : pages,
							page : page
						});
					} else {
						callback({
							data : [],
							start : 0,
							end : 0,
							count : 0,
							pages : 0,
							page : 0
						});
					}

				});

	}
};
