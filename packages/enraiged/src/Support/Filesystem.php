<?php

namespace Enraiged\Support;

use FilesystemIterator;
use Illuminate\Filesystem\Filesystem as IlluminateFilesystem;

class Filesystem extends IlluminateFilesystem
{
    /**
     *  Recursively delete a directory.
     *
     *  The directory itself may be optionally preserved and files optionally excepted.
     *
     *  @param  string  $directory
     *  @param  bool    $preserve
     *  @param  mixed   $exceptions
     *  @return bool
     */
    public function deleteDirectory($directory, $preserve = false, $exceptions = null)
    {
        if (!$this->isDirectory($directory)) {
            return false;
        }

        if (!is_array($exceptions)) {
            $exceptions = [$exceptions];
        }

        $items = new FilesystemIterator($directory);

        foreach ($items as $item) {
            // If the item is a directory, we can just recurse into the function and
            // delete that sub-directory otherwise we'll just delete the file and
            // keep iterating through each file until the directory is cleaned.
            if ($item->isDir() && ! $item->isLink()) {
                $this->deleteDirectory($item->getPathname());
            }

            // If the item is just a file, we can go ahead and delete it since we're
            // just looping through and waxing all of the files in this directory
            // and calling directories recursively, so we delete the real path.
            else {
                $path_name = $item->getPathname();

                // If any of the except items matches a regex comparison with the
                // file being deleted, it will leave the file intact.
                $matched_exception = false;

                foreach ($exceptions as $except) {
                    $match = str_replace('.', '\.', $except);

                    if (preg_match("/{$match}$/", $path_name)) {
                        $matched_exception = true;
                    }
                }

                if (!$matched_exception) {
                    $this->delete($path_name);
                }
            }
        }

        if (!$preserve) {
            @rmdir($directory);
        }

        return true;
    }

    /**
     *  Empty the specified directory of all files and folders.
     *
     *  @param  string  $directory
     *  @param  mixed   $exceptions
     *  @return bool
     */
    public function cleanDirectory($directory, $exceptions = null)
    {
        return $this->deleteDirectory($directory, true, $exceptions);
    }
}
