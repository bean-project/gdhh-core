<?php
namespace App\Service\Media\Provider;



class AppImageProvider extends ImageProvider
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct($name, Filesystem $filesystem, CDNInterface $cdn, GeneratorInterface $pathGenerator, ThumbnailInterface $thumbnail, array $allowedExtensions, array $allowedMimeTypes, ImagineInterface $adapter, MetadataBuilderInterface $metadata = null,ContainerInterface $container)
    {
        parent::__construct($name, $filesystem, $cdn, $pathGenerator, $thumbnail, $allowedExtensions, $allowedMimeTypes, $adapter, $metadata);
        $this->container = $container;

    }


    /**
     * {@inheritdoc}
     */
    public function generatePublicUrl(MediaInterface $media, $format)
    {
        if ($format == 'reference') {
            $path = $this->getReferenceImage($media);
        } else {
            $path = $this->thumbnail->generatePublicUrl($this, $media, $format);
        }
        $path = $this->container->getParameter('s3_directory') . '/' . $path;
        return $this->getCdn()->getPath($path, $media->getCdnIsFlushable());
    }

}