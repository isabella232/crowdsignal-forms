/**
 * External dependencies
 */
import React, { useState } from 'react';
import { get } from 'lodash';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { BlockControls } from '@wordpress/block-editor';
import {
	Popover,
	TextControl,
	ToolbarGroup,
	Toolbar,
} from '@wordpress/components';

/**
 * Internal dependencies
 */
import { DEFAULT_SIZE_CONTROLS, POPOVER_PROPS } from 'blocks/vote/constants';
import SizeIcon from 'components/icon/size';
import BorderIcon from 'components/icon/border';
import CounterIcon from 'components/icon/counter';

const ToolBar = ( { attributes, setAttributes } ) => {
	const size = get( attributes, 'size', 'medium' );
	const sizeControls = DEFAULT_SIZE_CONTROLS;

	const handleChangeBorderRadius = ( borderRadius ) => {
		setAttributes( {
			borderRadius: parseInt( borderRadius, 10 ) || 0,
		} );
	};

	const handleChangeBorderWidth = ( borderWidth ) => {
		setAttributes( {
			borderWidth: parseInt( borderWidth, 10 ) || 0,
		} );
	};

	const handleToggleResults = () =>
		setAttributes( {
			hideResults: ! attributes.hideResults,
		} );

	const [ isPopoverVisible, setPopoverVisible ] = useState( false );
	const handlePopoverVisible = () => setPopoverVisible( ! isPopoverVisible );

	const toggleResultsLabel = attributes.hideResults
		? __( 'Show vote counters', 'crowdsignal-forms' )
		: __( 'Hide vote counters', 'crowdsignal-forms' );

	return (
		<BlockControls>
			<ToolbarGroup
				isCollapsed={ true }
				icon={ SizeIcon }
				label={ __( 'Change block size', 'crowdsignal-forms' ) }
				popoverProps={ POPOVER_PROPS }
				controls={ sizeControls.map( ( control ) => {
					const { size: controlSize } = control;
					const isActive = size === controlSize;

					return {
						...control,
						isActive,
						role: 'menuitemradio',
						onClick: () => setAttributes( { size: controlSize } ),
					};
				} ) }
			/>
			<Toolbar
				controls={ [
					{
						icon: BorderIcon,
						onClick: handlePopoverVisible,
					},
					{
						icon: CounterIcon,
						label: toggleResultsLabel,
						onClick: handleToggleResults,
						isActive: ! attributes.hideResults, // Pre gutenberg 8
						isPressed: ! attributes.hideResults,
					},
				] }
			/>

			{ isPopoverVisible && (
				<Popover
					className="crowdsignal-forms__border-popover"
					onFocusOutside={ handlePopoverVisible }
				>
					<div className="crowdsignal-forms__row">
						<TextControl
							label={ __(
								'Border thickness',
								'crowdsignal-forms'
							) }
							type="number"
							className="crowdsignal-forms__small-text-input"
							onChange={ handleChangeBorderWidth }
							value={ attributes.borderWidth || 0 }
						/>
						<TextControl
							label={ __( 'Corner radius', 'crowdsignal-forms' ) }
							type="number"
							className="crowdsignal-forms__small-text-input"
							onChange={ handleChangeBorderRadius }
							value={ attributes.borderRadius || 0 }
						/>
					</div>
				</Popover>
			) }
		</BlockControls>
	);
};

export default ToolBar;
