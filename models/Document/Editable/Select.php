<?php
declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace Pimcore\Model\Document\Editable;

use Pimcore\Model;

/**
 * @method \Pimcore\Model\Document\Editable\Dao getDao()
 */
class Select extends Model\Document\Editable
{
    /**
     * Contains the current selected value
     *
     * @internal
     *
     * @var string
     */
    protected string $text;

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'select';
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): mixed
    {
        return $this->text;
    }

    public function getText(): string
    {
        return $this->getData();
    }

    /**
     * {@inheritdoc}
     */
    public function frontend()
    {
        return $this->text;
    }

    /**
     * {@inheritdoc}
     */
    public function setDataFromResource(mixed $data): static
    {
        $this->text = $data;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setDataFromEditmode(mixed $data): static
    {
        $this->text = (string)$data;

        return $this;
    }

    public function isEmpty(): bool
    {
        return empty($this->text);
    }
}
