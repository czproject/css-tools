<?php

	declare(strict_types=1);

	namespace CzProject\CssTools;


	class FluidSize implements CssValue
	{
		/** @var int */
		private $startPx;

		/** @var int */
		private $endPx;

		/** @var int */
		private $minWidth;

		/** @var int */
		private $maxWidth;


		public function __construct(
			int $startPx,
			int $endPx,
			int $minWidth,
			int $maxWidth
		)
		{
			$this->startPx = $startPx;
			$this->endPx = $endPx;
			$this->minWidth = min($minWidth, $maxWidth);
			$this->maxWidth = max($minWidth, $maxWidth);
		}


		public function render(): string
		{
			if ($this->startPx === $this->endPx) {
				return Number::px2rem($this->startPx)->render();
			}

			$widthRange = $this->maxWidth - $this->minWidth;

			if ($widthRange <= 0) {
				return Number::px2rem(max($this->startPx, $this->endPx))->render();
			}

			$widthRangeVw = $widthRange / 100;
			$startPxToVw = $this->startPx / $widthRangeVw;
			$endPxToVw = $this->endPx / $widthRangeVw;

			$factor = round($endPxToVw - $startPxToVw, 4);
			$cssFactor = new Number($factor, 'vi');

			$compensationPx = $this->startPx - ($factor * ($this->minWidth / 100));
			$cssCompensation = new Number(round($compensationPx / 16, 4), 'rem');

			return 'clamp('
				. Number::px2rem(min($this->startPx, $this->endPx))->render()
				. ', '
				. $cssCompensation->render()
				. ' + '
				. $cssFactor->render()
				. ', '
				. Number::px2rem(max($this->startPx, $this->endPx))->render()
				. ')';
		}
	}
