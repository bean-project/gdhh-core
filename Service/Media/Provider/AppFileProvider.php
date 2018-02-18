<?php
namespace App\Service\Media\Provider;


class AppFileProvider extends FileProvider
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct($name, Filesystem $filesystem, CDNInterface $cdn, GeneratorInterface $pathGenerator, ThumbnailInterface $thumbnail, array $allowedExtensions = array(), array $allowedMimeTypes = array(), MetadataBuilderInterface $metadata = null,ContainerInterface $container)
    {
        parent::__construct($name, $filesystem, $cdn, $pathGenerator, $thumbnail,$allowedExtensions,$allowedMimeTypes,$metadata);
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
            // @todo: fix the asset path
            $path = sprintf('sonatamedia/files/%s/file.png', $format);
        }
        $path = $this->container->getParameter('s3_directory') . '/' . $path;
        return $this->getCdn()->getPath($path, $media->getCdnIsFlushable());
    }
}