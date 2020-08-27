/**
 * External dependencies
 */
import React from 'react';

/**
 * WordPress dependencies
 */
import {
	Button,
	ExternalLink,
	PanelBody,
	TextControl,
	SelectControl,
	TimePicker,
} from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';

import { includes } from 'lodash';

import {
	PollStatus,
} from './constants';

/**
 * Internal dependencies
 */
import { __ } from 'lib/i18n';

const SideBar = ({ attributes, setAttributes, viewResultsUrl }) => {
	const handleChangeTitle = (title) => setAttributes({ title });

	const resultsLinkEnabled = '' !== viewResultsUrl;

	const handleChangePollStatus = (pollStatus) =>
		includes(PollStatus, pollStatus) && setAttributes({ pollStatus });

	const handleChangeCloseAfterDateTime = (closedAfterDateTime) => {
		const dateTime = new Date(closedAfterDateTime);
		setAttributes({ closedAfterDateTime: dateTime.toISOString() });
	};

	return (
		<InspectorControls>
			<PanelBody title={__('Results')} initialOpen={true}>
				<p>
					{resultsLinkEnabled
						? __('Manage results on ')
						: __('Publish this post to enable results on ')}
					<ExternalLink
						href={
							resultsLinkEnabled
								? viewResultsUrl
								: 'https://www.crowdsignal.com'
						}
					>
						crowdsignal.com
					</ExternalLink>
				</p>
				<p>
					<Button
						href={viewResultsUrl}
						isSecondary
						target="_blank"
						disabled={!resultsLinkEnabled}
					>
						{__('View results')}
					</Button>
				</p>

				<TextControl
					value={ attributes.title }
					label={ __( 'Title of the vote block' ) }
					onChange={ handleChangeTitle }
				/>
			</PanelBody>
			<PanelBody title={__('Status')}>
				<SelectControl
					value={attributes.pollStatus}
					label={__('Currently')}
					options={[
						{
							label: __('Open'),
							value: PollStatus.OPEN,
						},
						{
							label: __('Closed After'),
							value: PollStatus.CLOSED_AFTER,
						},
						{
							label: __('Closed'),
							value: PollStatus.CLOSED,
						},
					]}
					onChange={handleChangePollStatus}
				/>
				{PollStatus.CLOSED_AFTER === attributes.pollStatus && (
					<TimePicker
						currentTime={attributes.closedAfterDateTime}
						label={__('Close vote block on')}
						onChange={handleChangeCloseAfterDateTime}
						is12Hour={true}
					/>
				)}
			</PanelBody>
		</InspectorControls>
	);
};

export default SideBar;
