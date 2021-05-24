<?php

namespace PagSeguro\Http\Transaction;

use Common\Response;
use Common\XmlDecodable;
use PagSeguro\Http\Objects\Transaction;

class TransactionsResponse implements Response, XmlDecodable
{
    private int $currentPage;
    private int $totalPages;
    private int $resultsInThisPage;

    /** @var Transaction[] */
    private array $transactions = [];

    public function __construct(string $body)
    {
        $this->parse($body);
    }

    public function parse(string $body)
    {
        $xml = simplexml_load_string($body);
        $this->decode($xml);
    }

    public function decode(\SimpleXMLElement $root): XmlDecodable
    {
        $this->currentPage = (int) $root->currentPage;
        $this->totalPages = (int) $root->totalPages;
        $this->resultsInThisPage = (int) $root->resultsInThisPage;

        if ($transactions = $root->transactions) {
            foreach ($transactions->children() as $item) {
                $this->transactions[] = (new Transaction())->decode($item);
            }
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @return int
     */
    public function getResultsInThisPage(): int
    {
        return $this->resultsInThisPage;
    }

    /**
     * @return Transaction[]
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
