<?php
/**
 * This file is part of Lcobucci\JWT, a simple library to handle JWT and JWS
 *
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Lcobucci\JWT;

use Lcobucci\JWT\Claim\Factory as ClaimFactory;
use Lcobucci\JWT\Parsing\Encoder;
use Lcobucci\JWT\Signer\Key;
use function implode;

/**
 * This class makes easier the token creation process
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 * @since 0.1.0
 */
class Builder
{
    /**
     * The token header
     *
     * @var array
     */
    private $headers = ['typ' => 'JWT', 'alg' => 'none'];

    /**
     * The token claim set
     *
     * @var array
     */
    private $claims = [];

    /**
     * The data encoder
     *
     * @var Encoder
     */
    private $encoder;

    /**
     * The factory of claims
     *
     * @var ClaimFactory
     */
    private $claimFactory;

    /**
     * @var Signer|null
     */
    private $signer;

    /**
     * @var Key|null
     */
    private $key;

    /**
     * Initializes a new builder
     *
     * @param Encoder $encoder
     * @param ClaimFactory $claimFactory
     */
    public function __construct(
        Encoder $encoder = null,
        ClaimFactory $claimFactory = null
    )
    {
        $this->encoder = $encoder ?: new Encoder();
        $this->claimFactory = $claimFactory ?: new ClaimFactory();
    }

    /**
     * Configures the audience
     *
     * @deprecated This method has been wrongly added and doesn't exist on v4
     * @see Builder::permittedFor()
     *
     * @param string $audience
     * @param bool $replicateAsHeader
     *
     * @return Builder
     */
    public function canOnlyBeUsedBy($audience, $replicateAsHeader = false)
    {
        return $this->setRegisteredClaim('aud', (string)$audience, $replicateAsHeader);
    }

    /**
     * Configures the audience
     *
     * @param string $audience
     * @param bool $replicateAsHeader
     *
     * @return Builder
     */
    public function permittedFor($audience, $replicateAsHeader = false)
    {
        return $this->setRegisteredClaim('aud', (string)$audience, $replicateAsHeader);
    }

    /**
     * Configures the audience
     *
     * @param string $audience
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     * @see Builder::permittedFor()
     *
     * @deprecated This method will be removed on v4
     */
    public function setAudience($audience, $replicateAsHeader = false)
    {
        return $this->setRegisteredClaim('aud', (string)$audience, $replicateAsHeader);
    }

    /**
     * Configures the expiration time
     *
     * @param int $expiration
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     */
    public function expiresAt($expiration, $replicateAsHeader = false)
    {
        return $this->setRegisteredClaim('exp', (int)$expiration, $replicateAsHeader);
    }

    /**
     * Configures the expiration time
     *
     * @param int $expiration
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     * @see Builder::expiresAt()
     *
     * @deprecated This method will be removed on v4
     */
    public function setExpiration($expiration, $replicateAsHeader = false)
    {
        return $this->setRegisteredClaim('exp', (int)$expiration, $replicateAsHeader);
    }

    /**
     * Configures the token id
     *
     * @param string $id
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     */
    public function identifiedBy($id, $replicateAsHeader = false)
    {
        return $this->setRegisteredClaim('jti', (string)$id, $replicateAsHeader);
    }

    /**
     * Configures the token id
     *
     * @param string $id
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     * @see Builder::identifiedBy()
     *
     * @deprecated This method will be removed on v4
     */
    public function setId($id, $replicateAsHeader = false)
    {
        return $this->identifiedBy($id, $replicateAsHeader);
    }

    /**
     * Configures the time that the token was issued
     *
     * @param int $issuedAt
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     */
    public function issuedAt($issuedAt, $replicateAsHeader = false)
    {
        return $this->setRegisteredClaim('iat', (int)$issuedAt, $replicateAsHeader);
    }

    /**
     * Configures the time that the token was issued
     *
     * @param int $issuedAt
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     * @see Builder::issuedAt()
     *
     * @deprecated This method will be removed on v4
     */
    public function setIssuedAt($issuedAt, $replicateAsHeader = false)
    {
        return $this->issuedAt($issuedAt, $replicateAsHeader);
    }

    /**
     * Configures the issuer
     *
     * @param string $issuer
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     */
    public function issuedBy($issuer, $replicateAsHeader = false)
    {
        return $this->setRegisteredClaim('iss', (string)$issuer, $replicateAsHeader);
    }

    /**
     * Configures the issuer
     *
     * @param string $issuer
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     * @see Builder::issuedBy()
     *
     * @deprecated This method will be removed on v4
     */
    public function setIssuer($issuer, $replicateAsHeader = false)
    {
        return $this->issuedBy($issuer, $replicateAsHeader);
    }

    /**
     * Configures the time before which the token cannot be accepted
     *
     * @param int $notBefore
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     */
    public function canOnlyBeUsedAfter($notBefore, $replicateAsHeader = false)
    {
        return $this->setRegisteredClaim('nbf', (int)$notBefore, $replicateAsHeader);
    }

    /**
     * Configures the time before which the token cannot be accepted
     *
     * @param int $notBefore
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     * @see Builder::canOnlyBeUsedAfter()
     *
     * @deprecated This method will be removed on v4
     */
    public function setNotBefore($notBefore, $replicateAsHeader = false)
    {
        return $this->canOnlyBeUsedAfter($notBefore, $replicateAsHeader);
    }

    /**
     * Configures the subject
     *
     * @param string $subject
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     */
    public function relatedTo($subject, $replicateAsHeader = false)
    {
        return $this->setRegisteredClaim('sub', (string)$subject, $replicateAsHeader);
    }

    /**
     * Configures the subject
     *
     * @param string $subject
     * @param boolean $replicateAsHeader
     *
     * @return Builder
     * @see Builder::relatedTo()
     *
     * @deprecated This method will be removed on v4
     */
    public function setSubject($subject, $replicateAsHeader = false)
    {
        return $this->relatedTo($subject, $replicateAsHeader);
    }

    /**
     * Configures a header item
     *
     * @param string $name
     * @param mixed $value
     *
     * @return Builder
     */
    public function withHeader($name, $value)
    {
        $this->headers[(string)$name] = $this->claimFactory->create($name, $value);

        return $this;
    }

    /**
     * Configures a header item
     *
     * @param string $name
     * @param mixed $value
     *
     * @return Builder
     * @see Builder::withHeader()
     *
     * @deprecated This method will be removed on v4
     */
    public function setHeader($name, $value)
    {
        return $this->withHeader($name, $value);
    }

    /**
     * Configures a claim item
     *
     * @deprecated This method has been wrongly added and doesn't exist on v4
     * @see Builder::withClaim()
     *
     * @param string $name
     * @param mixed $value
     *
     * @return Builder
     */
    public function with($name, $value)
    {
        return $this->withClaim($name, $value);
    }

    /**
     * Configures a claim item
     *
     * @param string $name
     * @param mixed $value
     *
     * @return Builder
     */
    public function withClaim($name, $value)
    {
        $this->claims[(string)$name] = $this->claimFactory->create($name, $value);

        return $this;
    }

    /**
     * Configures a claim item
     *
     * @param string $name
     * @param mixed $value
     *
     * @return Builder
     * @see Builder::withClaim()
     *
     * @deprecated This method will be removed on v4
     */
    public function set($name, $value)
    {
        return $this->withClaim($name, $value);
    }

    /**
     * Signs the data
     *
     * @param Signer $signer
     * @param Key|string $key
     *
     * @return Builder
     * @see Builder::getToken()
     *
     * @deprecated This method will be removed on v4
     */
    public function sign(Signer $signer, $key)
    {
        if (!$key instanceof Key) {
            $key = new Key($key);
        }

        $this->signer = $signer;
        $this->key = $key;

        return $this;
    }

    /**
     * Removes the signature from the builder
     *
     * @return Builder
     * @see Builder::getToken()
     *
     * @deprecated This method will be removed on v4
     */
    public function unsign()
    {
        $this->signer = null;
        $this->key = null;

        return $this;
    }

    /**
     * Returns the resultant token
     *
     * @return Token
     */
    public function getToken(Signer $signer = null, Key $key = null)
    {
        $signer = $signer ?: $this->signer;
        $key = $key ?: $this->key;

        if ($signer instanceof Signer) {
            $signer->modifyHeader($this->headers);
        }

        $payload = [
            $this->encoder->base64UrlEncode($this->encoder->jsonEncode($this->headers)),
            $this->encoder->base64UrlEncode($this->encoder->jsonEncode($this->claims))
        ];

        $signature = $this->createSignature($payload, $signer, $key);

        if ($signature !== null) {
            $payload[] = $this->encoder->base64UrlEncode($signature);
        }

        return new Token($this->headers, $this->claims, $signature, $payload);
    }

    /**
     * Configures a registered claim
     *
     * @param string $name
     * @param mixed $value
     * @param boolean $replicate
     *
     * @return Builder
     */
    protected function setRegisteredClaim($name, $value, $replicate)
    {
        $this->withClaim($name, $value);

        if ($replicate) {
            $this->headers[$name] = $this->claims[$name];
        }

        return $this;
    }

    /**
     * @param string[] $payload
     *
     * @return Signature|null
     */
    private function createSignature(array $payload, Signer $signer = null, Key $key = null)
    {
        if ($signer === null || $key === null) {
            return null;
        }

        return $signer->sign(implode('.', $payload), $key);
    }
}
